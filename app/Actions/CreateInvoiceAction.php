<?php

namespace App\Actions;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class CreateInvoiceAction
{
    public static function execute(): Invoice
    {
        return DB::transaction(function () {
            $data = self::makeData();
            $invoice = self::createInvoice();
    
            $invoice->products()->attach($data);

            Cart::destroy();
            
            return $invoice;
        });
    }

    private static function makeData(): array
    {
        $data = [];

        foreach (Cart::content() as $product) {
            $data[$product->id] = [
                'quantity' => $product->qty,
                'price' => (int) $product->price,
                'subtotal' => (int) $product->price * $product->qty,
            ];
        }

        return $data;
    }

    private static function createInvoice(): Invoice
    {
        $invoice = new Invoice();
        $invoice->reference = self::generateReference();
        $invoice->total = Cart::subtotal(0, '.', '');
        $invoice->user_id = auth()->id();
        $invoice->payment_expiration = now()->addHours(12);
        $invoice->save();

        return $invoice;
    }

    private static function generateReference(): string
    {
        do {
            $reference = null;
            $temporaryReference = date('ymd') . strtoupper(Str::random(6));
            
            if (!Invoice::where('reference', $temporaryReference)->exists()) {
                $reference = $temporaryReference;
            }
        } while (is_null($reference));

        return $reference;
    }
}
