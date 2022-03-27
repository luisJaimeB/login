<?php

namespace App\Actions;

use App\Models\Invoice;
use App\Services\WebCheckoutService;
use Illuminate\Support\Facades\Log;

class PaymentRedirectionAction
{
    public static function execute(WebCheckoutService $webCheckout, Invoice $invoice)
    {
        $response = $webCheckout->buildData($invoice)
            ->createSession();
        
        if (isset($response['requestId'])) {
            $invoice->update(['request_id'=> $response['requestId']]);
            
            return redirect()->away($response['processUrl']);
        } else {
            Log::channel('payments')
                ->error("Payment error for invoice No. {$invoice->reference}", $response);

            return back()->with('error', 'Estamos teniendo problemas, regresa más tarde!!');
        }
    }

}
