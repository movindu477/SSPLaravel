<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Public Pages (No Login Required)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');

Route::get('/payment', function () {
    return view('pages.payment');
})->name('payment');

/*
|--------------------------------------------------------------------------
| Authentication (WEB SESSION BASED)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated User Pages
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('dashboard');

    Route::get('/products', [AdminController::class, 'products'])
        ->name('products');

    Route::get('/products/create', [AdminController::class, 'createProduct'])
        ->name('create-product');

    Route::post('/products', [AdminController::class, 'storeProduct'])
        ->name('store-product');

    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])
        ->name('edit-product');

    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])
        ->name('update-product');

    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])
        ->name('delete-product');

    Route::get('/users', [AdminController::class, 'users'])
        ->name('users');
});

// cart add route
Route::middleware('auth')->post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');