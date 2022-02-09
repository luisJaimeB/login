<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/categories/create', [CategoryController::class, 'create'])
->name('categories.create');

Route::get('/categories', [CategoryController::class, 'index'])
->name('categories.index');

Route::post('/categories', [CategoryController::class, 'store'])
->name('categories.store');

Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])
    ->name('categories.edit');

Route::put('/categories/{category}', [CategoryController::class, 'update'])
    ->name('categories.update');

Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->name('categories.destroy');