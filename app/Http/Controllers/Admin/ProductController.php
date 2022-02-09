<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexProductRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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

        return view('admin.products.index', compact('products'));
    }


    public function create(): View
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }


    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $product = Product::create($request->only('name', 'description', 'price', 'category_id'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->hashName();
            $file->storeAs('public', $imageName);

            $image = new Image();
            $image->path = $imageName;
            $image->product()->associate($product);
            $image->save();
        }

        return redirect()->route('admin.products.index')->with('success', 'producto creado correctamente');
    }


    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }


    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }


    public function update(ProductEditRequest $request, Product $product): RedirectResponse
    {
        $data = $request->only('name', 'description', 'price', 'category_id');

        $product->load('images');
        $image = $product->images->first();

        if ($request->hasFile('image')) {
            if (File::exists($image)) {
                File::delete($image);
            }

            $file = $request->file('image');
            $imageName = $file->hashName();
            $file->storeAs('public', $imageName);

            $image->path = $imageName;
            $image->product()->associate($product);
            $image->update();
        }

        $product->update($data);

        return redirect()->route('admin.products.show', $product->id)->with('success', 'Producto actualizado satisfactoriamente');
    }


    public function destroy(Product $product): RedirectResponse
    {
        $product->load('images');
        $image = $product->images->first();


        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
        $image->delete();
        $product->delete();

        return back()->with('success', 'Producto eliminado correctamente');
    }
}
