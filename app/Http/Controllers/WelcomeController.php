<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(IndexProductRequest $request): View
    {
        $products = Product::search($request->input('search'))
            ->whereCategory($request->input('category_id'))
            ->whereEnabled()
            ->with(['category', 'image'])
            ->latest()
            ->paginate(config('settings.pagination'));
        
        return view('welcome', compact('products'));
    }
}
