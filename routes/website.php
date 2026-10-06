<?php

use App\Http\Controllers\Website\Auth\AuthController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PageController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

Route::name('website.')->group(function () {

    Route::name('auth.')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    });

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/bestseller', [HomeController::class, 'bestseller'])->name('bestseller');

    Route::name('products.')->prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{id}', [ProductController::class, 'show'])->name('show');
    });

    Route::middleware('website.auth')->group(function () {

         Route::resource('categories', App\Http\Controllers\CategoryController::class);

        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::name('carts.')->prefix('carts')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('index');
            Route::get('/create/{id}', [CartController::class, 'addToCart'])->name('create');
            Route::post('/update/{id}', [CartController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [CartController::class, 'remove'])->name('delete');
            Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        });
    });
    Route::name('pages.')->prefix('pages')->group(function () {
        Route::get('/about', [PageController::class, 'about'])->name('about');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    });

    
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard (redirect to products list)
    Route::get('/', function () {
        return redirect()->route('website.admin.products.index');
    })->name('dashboard');

    // Products CRUD
    Route::resource('products', AdminProductController::class);
});