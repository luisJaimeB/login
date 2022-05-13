<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryEditRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::paginate(config('settings.pagination'));

        return view('admin.categories.index', compact('categories'));
    }


    public function create(): View
    {
        return view('admin.categories.create');
    }


    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        Category::create($request->only('name'));

        Cache::destroy('categories');

        return redirect()->route('admin.categories.index')->with('success', 'categoría creada correctamente');
    }


    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }


    public function update(CategoryEditRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->only('name'));

        Cache::destroy('categories');

        return redirect()->route('admin.categories.index')->with('success', 'categoría actualizada correctamente');
    }


    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        Cache::destroy('categories');

        return redirect()->route('admin.categories.index')->with('success', 'Categoría eliminada correctamente');
    }
}
