<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesProductsExport implements FromView
{
    public function view(): View
    {
        $products = Product::with('invoices:id')->get(['id', 'name', 'created_at']);

        return view('admin.exports.sales', [
            'products' => $products,
        ]);
    }
}
