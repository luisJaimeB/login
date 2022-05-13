<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ImportType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImportRequest;
use App\Imports\ProductsImport;
use App\Models\Import;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{
    public function index(): View
    {
        $imports = Import::latest()->paginate(config('settings.pagination'));

        return view('admin.products.imports.index', compact('imports'));
    }

    public function create():View
    {
        return view('admin.products.imports.create'); 
    }

    public function store(StoreImportRequest $request)
    {
        $file = $request->file('import_file');

        $import = Import::create([
            'file_name' => $file->getClientOriginalName(),
            'import_type' => ImportType::PRODUCTS,
        ]);
        
        Excel::import(new ProductsImport($import), $file);

        return redirect()->route('admin.products.index')->with('success', 'Su importe está siendo procesado.');
    }
}
