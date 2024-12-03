<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Category;

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
Route::get('/edit-product/{product}', [ProductController::class, 'edit'])->name('edit-product');
Route::put('/edit-product/{product}', [ProductController::class, 'update'])->name('update-product');


Route::get('/category', [CategoryController::class, 'index'])->name('category');

Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');

Route::post('/add-category', [CategoryController::class, 'store'])->name('store-category');
