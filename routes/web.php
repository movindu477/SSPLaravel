<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\API\FavoriteController;

Route::get('/test-db', function () {
    try {
        $dbName = DB::connection()->getDatabaseName();
        $tables = DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_CATALOG = ?", [$dbName]);
        return response()->json([
            'database' => $dbName,
            'tables' => array_column($tables, 'TABLE_NAME'),
            'user_table_exists' => DB::select("SELECT COUNT(*) as count FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'User' AND TABLE_CATALOG = ?", [$dbName])[0]->count > 0
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->name('test-db');

Route::get('/', function () {
    return view('pages.home');
})->middleware('redirect.admin')->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->middleware('redirect.admin')->name('about');

Route::get('/shop', [ProductController::class, 'index'])->middleware('redirect.admin')->name('shop');
Route::get('/product/{id}', [ProductController::class, 'show'])->middleware('redirect.admin')->name('product.show');

Route::get('/cart', function () {
    return view('pages.cart');
})->middleware('redirect.admin')->name('cart');

Route::get('/payment', function () {
    return view('pages.payment');
})->middleware(['auth', 'redirect.admin'])->name('payment');

Route::post('/stripe/checkout', [App\Http\Controllers\StripeController::class, 'createCheckoutSession'])
    ->middleware('auth')
    ->name('stripe.checkout');

Route::get('/stripe/success', [App\Http\Controllers\StripeController::class, 'success'])
    ->middleware('auth')
    ->name('stripe.success');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/profile', function () {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.profile');
        }
        return app(ProfileController::class)->index();
    })->name('profile');

    Route::post('/cart/add', [CartController::class, 'add'])
        ->name('cart.add');

    // Favorites routes for web (using web session auth)
    Route::get('/api/favorites', [FavoriteController::class, 'index']);
    Route::post('/api/favorites', [FavoriteController::class, 'store']);
    Route::delete('/api/favorites/{petId}', [FavoriteController::class, 'destroy']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

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

    Route::get('/users/create', [AdminController::class, 'createUser'])
        ->name('create-user');

    Route::post('/users', [AdminController::class, 'storeUser'])
        ->name('store-user');

    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])
        ->name('edit-user');

    Route::put('/users/{id}', [AdminController::class, 'updateUser'])
        ->name('update-user');

    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])
        ->name('delete-user');

    Route::get('/profile', [AdminController::class, 'profile'])
        ->name('profile');
});
