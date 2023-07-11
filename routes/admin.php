<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'auth.type:admin,super-admin'])->prefix('admin')->group(function () {
    Route::get('/new', function () {
        return view('layouts.admin');
    });
    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoryController::class);

    Route::get('/products/trashed', [ProductController::class, 'trashedProduct'])->name('products.trashed');

    Route::put('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

    Route::delete('/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
});
