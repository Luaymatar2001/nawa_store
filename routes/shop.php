<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\store\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeController::class, 'index'])->name('home');

Route::get('/product/{slug}', [ProductsController::class, 'show'])->name('shop.products.show');

// Route::get('reviews/{slug}', [ReviewController::class , 'index'])->name('product.reviews');
Route::post('reviews/{slug}', [ReviewController::class, 'store'])->name('product.reviews.store');

