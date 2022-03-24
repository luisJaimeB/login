<?php

namespace App\Http\Controllers;

use App\Actions\CreateInvoiceAction;
use App\Actions\QueryInvoiceAction;
use App\Actions\UpdateUserAction;
use App\Constants\InvoiceStatus;
use App\Constants\PaymentStatus;
use App\Models\Invoice;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use App\Request\GetInformationRequest;
use App\Services\WebCheckoutService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index(): View
    {
        $documentTypes = DocumentType::all();

        return view('products.checkout', compact('documentTypes'));
    }

    public function store(UserUpdateRequest $request, WebCheckoutService $webCheckout)
    {
        UpdateUserAction::update($request->validated());

        $invoice = CreateInvoiceAction::excecute();

        $response = $webCheckout->buildData($invoice)
            ->createSession();
        
        if (isset($response['requestId'])) {
            $invoice->update(['request_id'=> $response['requestId']]);
            Cart::destroy();
            return redirect()->away($response['processUrl']);
        }else{
            Log::channel('payments')
                ->error("Payment error for invoice No. {$invoice->number}", $response);

            return redirect()->route('checkout.index')->with('error', 'Estamos teniendo problemas, regresa más tarde!!');
        }
    }

    // COmplete or process
    public function edit(WebCheckoutService $webCheckout, string $number)
    {
        $invoice = Invoice::where('number', $number)
            ->whereNotNull('request_id')
            ->firstOrFail();
        
        QueryInvoiceAction::excecute($webCheckout, $invoice);

        return redirect()->route('invoices.show', $invoice);
    }
}
