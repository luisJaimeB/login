<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{
    public function create():View
    {
        return view('admin.products.imports.create'); 
    }

    public function store(Request $request)
    {
        $file = $request->file('impot_file');
        
        Excel::import(new ProductsImport, $file);

        return redirect()->route('admin.products.index')->with('success', 'Productos cargados con exito.');
    }
}
