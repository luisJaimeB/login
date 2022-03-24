<?php

namespace App\Actions;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class CreateInvoiceAction
{
    public static function excecute(): Invoice
    {
        return DB::transaction(function () {
            $data = self::makeData();
            $invoice = self::createInvoice();
    
            $invoice->products()->attach($data);
            
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
        $invoice->number = self::generateNumber();
        $invoice->total = Cart::subtotal(0, '.', '');
        $invoice->user_id = auth()->id();
        $invoice->save();

        return $invoice;
    }

    private static function generateNumber(): string
    {
        do {
            $number = null;
            $temporaryNumber = date('ymd') . strtoupper(Str::random(6));
            
            if (!Invoice::where('number', $temporaryNumber)->exists()) {
                $number = $temporaryNumber;
            }
        } while (is_null($number));

        return $number;
    }
}
