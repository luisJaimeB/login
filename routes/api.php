<?php

use App\Http\Controllers\Admin\Api\ProductController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'token_name' => 'required|string'
    ]);
 
    $user = User::where('email', $request->email)->first();
    
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    
    return $user->createToken($request->token_name)->plainTextToken;
});

Route::group( ['middleware' => ["auth:sanctum"]], function(){

    Route::get('/products', [ProductController::class, 'index'])
        ->name('api.products');
        /* ->middleware('auth', 'role:Admin', 'verified'); */
    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('api.products');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('api.products.store');
    
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('api.products.update');
    
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('api.products.delete');
} );