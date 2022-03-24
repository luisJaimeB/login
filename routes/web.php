<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        require_once __DIR__ . '/admin/products.php';
        require_once __DIR__ . '/admin/categories.php';
    });

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::group(['middleware' => ['auth', 'role:Admin', 'verified']], function () {
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('permission:users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:users.index');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware('permission:users.show');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('permission:users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('permission:users.destroy');

    Route::get('/users/{user}/changeStatusUser', [UserController::class, 'changeStatusUser'])
        ->name('users.change.status');


    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create')
        ->middleware('permission:roles.create');

    Route::post('/roles', [RoleController::class, 'store'])
        ->name('roles.store');

    Route::get('/roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware('permission:roles.index');

    Route::get('/roles/{role}', [RoleController::class, 'show'])
        ->name('roles.show')
        ->middleware('permission:roles.show');

    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware('permission:roles.edit');

    Route::put('/roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update');

    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware('permission:roles.destroy');

    Route::resource('permissions', PermissionController::class);
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    
    Route::get('checkout', [PaymentController::class, 'index'])
        ->name('checkout.index');

    Route::post('checkout', [PaymentController::class, 'store'])
        ->name('checkout.store');

    Route::get('checkout/{number}/edit', [PaymentController::class, 'edit'])
        ->name('checkout.edit');

    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])
        ->name('invoices.show');

    Route::get('invoices', [InvoiceController::class, 'index'])
        ->name('invoices.index');
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');
    
Route::get('cart', [ShoppingCartController::class, 'index'])
    ->name('cart.index');

Route::post('cart', [ShoppingCartController::class, 'store'])
    ->name('cart.store');

Route::put('cart/{id}', [ShoppingCartController::class, 'update'])
    ->name('cart.update');

Route::delete('cart/{id}', [ShoppingCartController::class, 'remove'])
    ->name('cart.remove');

Route::delete('cart', [ShoppingCartController::class, 'destroy'])
    ->name('cart.destroy');
