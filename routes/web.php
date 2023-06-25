<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/new', function () {
    return view('layouts.admin');
});
Route::get('/products/trashed', [ProductController::class, 'trashedProduct'])->name('products.trashed');

Route::put('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

// Route::delete('/products/{product}/force', [ProductController::class, 'forceDelete'])->name('products.force-delete');

Route::resource('/products', ProductController::class);
Route::resource('/categories', CategoryController::class);


require __DIR__ . '/auth.php';
