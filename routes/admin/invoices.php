<?php

use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InvoicePdfController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])
        ->name('invoices.show');

Route::get('invoices', [InvoiceController::class, 'index'])
        ->name('invoices.index');

Route::put('invoices/{invoice}', [PaymentController::class, 'update'])
        ->name('invoices.update');

        
Route::get('report/invoices/create', [InvoicePdfController::class, 'create'])
    ->name('report.invoices.create');

Route::get('report/invoices', [InvoicePdfController::class, 'index'])
    ->name('report.invoices');