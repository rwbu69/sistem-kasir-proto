<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Product routes
Route::resource('products', ProductController::class);

// Sale routes
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('/cashier', [SaleController::class, 'cashier'])->name('sales.cashier');
Route::post('/sales/process', [SaleController::class, 'processSale'])->name('sales.process');
Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])->name('sales.receipt');
