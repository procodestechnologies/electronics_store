<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('', function () {
        return view('layouts.frontend.home');
    })->name('home');
    Route::get('/shop', function () {
        return view('layouts.frontend.shop');
    })->name('shop');
    Route::get('/cart', function () {
        return view('layouts.frontend.cart');
    })->name('cart');
    Route::get('/checkout', function () {
        return view('layouts.frontend.checkout');
    })->name('checkout');
    Route::get('/contact', function () {
        return view('layouts.frontend.contact');
    })->name('contact');
    Route::get('/search/{query}', [SearchController::class, 'index'])->name('search');
    Route::resource('products', FrontendProductController::class)->names(['products']);
});
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('/brands', BrandController::class)->names(['brands']);
    Route::resource('/categories', CategoryController::class)->names(['categories']);
    Route::resource('/products', ProductController::class)->names('admin.products');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});


require __DIR__ . '/settings.php';
