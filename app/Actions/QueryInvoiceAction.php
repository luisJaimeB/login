<?php

namespace App\Actions;

use App\Constants\InvoiceStatus;
use App\Constants\PaymentStatus;
use App\Models\Invoice;
use App\Services\WebCheckoutService;

class QueryInvoiceAction
{
    public static function excecute(WebCheckoutService $webCheckout, Invoice $invoice): void
    {
        $response = $webCheckout->getInformation($invoice->request_id);

        $status = isset($response['status']) && isset($response['status']['status'])
            ? $response['status']['status']
            : null;
    
        if ($status && PaymentStatus::completed($status)) {
            $invoice->invoice_status = InvoiceStatus::STATUS[$status];
            $invoice->save();
        }
    }
}
