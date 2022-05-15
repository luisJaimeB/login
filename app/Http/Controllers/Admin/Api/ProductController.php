<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return $products;
    }

    public function store(ProductCreateRequest $request)
    {
        $product = Product::create($request->only('name', 'description', 'price', 'category_id', 'quantity'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->hashName();
            $file->storeAs('public', $imageName);

            $image = new Image();
            $image->path = $imageName;
            $image->product()->associate($product);
            $image->save();
        }
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductEditRequest $request, Product $product)
    {
        $data = $request->only('name', 'description', 'price', 'category_id', 'quantity');

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

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->load('images');
        $image = $product->images->first();


        if ($image and Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
        $product->delete();

        return response('ok');
    }
}
