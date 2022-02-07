<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexProductRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProductRequest $request): View
    {   
        $products = Product::search($request->input('search'))
            ->whereCategory($request->input('category_id'))
            ->with(['category', 'image'])
            ->latest()
            ->paginate(config('settings.pagination'));
        
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        //dd($product);
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        
        $product = Product::create($request->only('name', 'description', 'price', 'category_id'));
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->hashName();
            $file->storeAs('public', $imageName);

            $image = New Image;
            $image->path = $imageName;
            $image->product()->associate($product);
            $image->save();
        }
        
        //dd($product);

        return redirect()->route('admin.products.index')->with('success', 'producto creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductEditRequest $request, Product $product)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
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
