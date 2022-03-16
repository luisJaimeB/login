<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index'])
    ->name('products.index')
    ->middleware('auth', 'role:Admin', 'verified');

Route::get('products/create', [ProductController::class, 'create'])
    ->name('products.create')
    ->middleware('auth', 'role:Admin', 'verified');

Route::post('products', [ProductController::class, 'store'])
    ->name('products.store')
    ->middleware('auth', 'role:Admin', 'verified');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show')
    ->middleware('auth', 'role:Admin', 'verified');

Route::get('products/{product}/edit', [ProductController::class, 'edit'])
    ->name('products.edit')
    ->middleware(['permission:admin.products.edit', 'auth', 'role:Admin', 'verified']);

Route::put('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update')
    ->middleware('auth', 'role:Admin', 'verified');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy')
    ->middleware(['permission:admin.products.destroy', 'auth', 'role:Admin', 'verified']);

Route::get('/products/{product}/changeStatusProduct', [ProductController::class, 'changeStatusProduct'])
    ->name('products.change.status');