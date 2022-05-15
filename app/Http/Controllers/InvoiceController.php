<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(): View
    {
        $invoices = Invoice::hisInvoices(Auth::id())->paginate(config('settings.pagination'));

        return view('invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load('products');

        return view('invoices.show', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        $invoice->load('products');

        $view = view('invoices.downloadInvoice', compact('invoice'))->render();

        $pdf = SnappyPdf::loadHTML($view);

        return $pdf->inline();
    }
}
