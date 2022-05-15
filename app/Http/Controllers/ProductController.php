<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(IndexProductRequest $request): View
    {
        $products = Product::search($request->input('search'))
            ->whereCategory($request->input('category_id'))
            ->with(['category', 'image'])
            ->latest()
            ->paginate(config('settings.pagination'));

        return view('products.index', compact('products'));
    }


    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }
}
