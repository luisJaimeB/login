<?php

namespace App\Http\Controllers;

use App\Actions\CreateInvoiceAction;
use App\Actions\PaymentRedirectionAction;
use App\Actions\UpdateUserAction;
use App\Actions\VerifyPaymentStatus;
use App\Constants\PaymentStatus;
use App\Models\Invoice;
use Illuminate\View\View;
use App\Models\DocumentType;
use App\Http\Requests\UserUpdateRequest;
use App\Services\WebCheckoutService;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function index(): View
    {
        $documentTypes = DocumentType::all();

        return view('products.checkout', compact('documentTypes'));
    }

    public function store(UserUpdateRequest $request, WebCheckoutService $webCheckout, Invoice $invoice): RedirectResponse
    {
        UpdateUserAction::update($request->validated());

        $invoice = CreateInvoiceAction::execute();
    
        return PaymentRedirectionAction::execute($webCheckout, $invoice);
    }

    public function retry(WebCheckoutService $webCheckout, string $reference): RedirectResponse
    {
        $invoice = Invoice::where('reference', $reference)
            ->whereIn('invoice_status', [PaymentStatus::PENDING, PaymentStatus::REJECTED])
            ->firstOrFail();
        
        return PaymentRedirectionAction::execute($webCheckout, $invoice);
    }

    public function verify(WebCheckoutService $webCheckout, string $reference): RedirectResponse
    {
        $invoice = Invoice::where('reference', $reference)
            ->whereNotNull('request_id')
            ->where('invoice_status', PaymentStatus::PENDING)
            ->firstOrFail();
    
        VerifyPaymentStatus::execute($webCheckout, $invoice);

        return redirect()->route('invoices.show', $invoice);
    }
}
