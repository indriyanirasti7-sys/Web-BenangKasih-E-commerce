<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC ───────────────────────────────────────────────
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');

// ─── AUTH ─────────────────────────────────────────────────
require __DIR__.'/auth.php';

// ─── DASHBOARD REDIRECT ───────────────────────────────────
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

// ─── PROFILE ──────────────────────────────────────────────
Route::get('/profile', function () {
    return redirect()->route('customer.profile');
})->middleware(['auth'])->name('profile.edit');

// ─── CUSTOMER ─────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::put('/profil', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
});

// ─── ADMIN ────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/customer-view', [AdminController::class, 'customerView'])->name('customer.view');

    // Products
    Route::get('/produk',                    [AdminController::class, 'products'])->name('products');
    Route::get('/produk/tambah',             [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/produk',                   [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/produk/{product}/edit',     [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/produk/{product}',          [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/produk/{product}',       [AdminController::class, 'destroyProduct'])->name('products.destroy');

    // Categories
    Route::get('/kategori',                  [AdminController::class, 'categories'])->name('categories');
    Route::post('/kategori',                 [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/kategori/{category}',       [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/kategori/{category}',    [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    // Gallery
    Route::get('/galeri',                    [GalleryAdminController::class, 'index'])->name('gallery');
    Route::post('/galeri',                   [GalleryAdminController::class, 'store'])->name('gallery.store');
    Route::delete('/galeri/{gallery}',       [GalleryAdminController::class, 'destroy'])->name('gallery.destroy');
});