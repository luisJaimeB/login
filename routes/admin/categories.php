<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/categories/create', [CategoryController::class, 'create'])
->name('categories.create')
->middleware('auth', 'role:Admin', 'verified');

Route::get('/categories', [CategoryController::class, 'index'])
->name('categories.index')
->middleware('auth', 'role:Admin', 'verified');

Route::post('/categories', [CategoryController::class, 'store'])
->name('categories.store')
->middleware('auth', 'role:Admin', 'verified');

Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])
    ->name('categories.edit')
    ->middleware('auth', 'role:Admin', 'verified');

Route::put('/categories/{category}', [CategoryController::class, 'update'])
    ->name('categories.update')
    ->middleware('auth', 'role:Admin', 'verified');

Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->name('categories.destroy')
    ->middleware('auth', 'role:Admin', 'verified');
