<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImportRequest;
use App\Models\Import;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImportController extends Controller
{
    public function index()
    {
        $imports = Import::latest()->paginate(config('settings.pagination'));

        return view('admin.products.imports.index', compact('imports'));
    }

    public function show(Import $import): View
    {
        return view('admin.products.imports.show', compact('import'));
    }

    public function destroy(Import $import): RedirectResponse
    {
        $import->delete();

        return back()->with('success', 'Importe eliminado correctamente');
    }
}
