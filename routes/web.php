<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
});

Route::get('/add-product', [ProductController::class, 'create'])->name('add-product');

Route::post('/add-product', [ProductController::class, 'store'])->name('store-product');
