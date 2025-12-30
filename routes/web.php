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

// Shop & Products
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Cart & Payment pages (view only)
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

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated User Pages
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    // Cart (site)
    Route::post('/cart/add', [CartController::class, 'add'])
        ->name('cart.add');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (ADMIN ONLY 🔐)
|--------------------------------------------------------------------------
| NOTE:
| We protect admin routes using:
| - auth middleware
| - role check inside AdminController (recommended)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin - Products CRUD
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | Admin - Users CRUD
    |--------------------------------------------------------------------------
    */
    Route::get('/users', [AdminController::class, 'users'])
        ->name('users');
});
