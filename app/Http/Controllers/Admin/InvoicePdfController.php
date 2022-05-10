<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DateRangeRequest;
use Barryvdh\Snappy\Facades\SnappyPdf;

class InvoicePdfController extends Controller
{
    public function create(): View
    {
        $products = Product::all();
        $categories = Category::all();


        return view('admin.reports.invoices.create', compact('products', 'categories'));
    }

    public function index(DateRangeRequest $request)
    {
        $invoices = Invoice::whereBetweenDate($request->query('start_date'), $request->query('end_date'))->get();

        $view = view('admin.reports.invoices.invoicesReport', compact('invoices'))->render();
        
        $pdf = SnappyPdf::loadHTML($view);
        
        return $pdf->inline();

        /* return view('admin.reports.report', compact('invoices'))->render(); */
        
    }
}
