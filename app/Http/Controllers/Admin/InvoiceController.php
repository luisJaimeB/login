<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(): View
    {
        $invoices = Invoice::latest()->paginate(config('settings.pagination'));

        return view('invoices.index', compact('invoices'));   
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load('products');

        return view('invoices.show', compact('invoice'));
    }
}
