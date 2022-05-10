<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRangeRequest;
use App\Models\Product;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductPdfController extends Controller
{
    public function create(): View
    {
        return view('admin.reports.products.create');
    }

    public function index(DateRangeRequest $request)
    {
        $products = Product::whereBetweenDate($request->query('start_date'), $request->query('end_date'))->get();

        $view = view('admin.reports.products.productsReport', compact('products'))->render();
        
        $pdf = SnappyPdf::loadHTML($view)->setOrientation('landscape');
        
        return $pdf->inline();

        /* return view('admin.reports.report', compact('invoices'))->render(); */
        
    }
}
