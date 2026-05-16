<?php
// routes/web.php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GalleryAdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC ROUTES ────────────────────────────────────────────────────────────
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');

// ─── AUTH ROUTES ──────────────────────────────────────────────────────────────
require __DIR__.'/auth.php';

// ─── CUSTOMER ROUTES ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:customer,admin'])->group(function () {
    Route::get('/profil', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::put('/profil', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
});

// ─── ADMIN ROUTES ─────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/',                     [AdminController::class, 'dashboard'])->name('dashboard');

    // Switch view
    Route::get('/customer-view',        [AdminController::class, 'customerView'])->name('customer.view');

    // Products CRUD
    Route::get('/produk',               [AdminController::class, 'products'])->name('products');
    Route::get('/produk/tambah',        [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/produk',              [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/produk/{product}/edit',[AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/produk/{product}',     [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/produk/{product}',  [AdminController::class, 'destroyProduct'])->name('products.destroy');

    // Categories CRUD
    Route::get('/kategori',             [AdminController::class, 'categories'])->name('categories');
    Route::post('/kategori',            [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/kategori/{category}',  [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/kategori/{category}',[AdminController::class, 'destroyCategory'])->name('categories.destroy');

    // Gallery Admin
    Route::get('/galeri',               [GalleryAdminController::class, 'index'])->name('gallery');
    Route::post('/galeri',              [GalleryAdminController::class, 'store'])->name('gallery.store');
    Route::delete('/galeri/{gallery}',  [GalleryAdminController::class, 'destroy'])->name('gallery.destroy');
});