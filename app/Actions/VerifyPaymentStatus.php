<?php

namespace App\Actions;

use App\Constants\InvoiceStatus;
use App\Constants\PaymentStatus;
use App\Models\Invoice;
use App\Services\WebCheckoutService;

class VerifyPaymentStatus
{
    public static function execute(WebCheckoutService $webCheckout, Invoice $invoice): void
    {
        $response = $webCheckout->getInformation($invoice->request_id);
        $status = isset($response['status'], $response['status']['status'])
            ? $response['status']['status']
            : null;

        if ($status && PaymentStatus::completed($status)) {
            $invoice->invoice_status = InvoiceStatus::STATUS[$status];
            $invoice->issuer_name = $response['payment'][0]['issuerName'];
            $invoice->payment_method_name = $response['payment'][0]['paymentMethodName'];
            $invoice->date = $response['status']['date'];
            $invoice->save();

            return;
        }

        if (now()->isAfter($invoice->payment_expiration)) {
            $invoice->invoice_status = InvoiceStatus::CANCELED;
            $invoice->request_id = null;
            $invoice->save();
        }
    }
}
