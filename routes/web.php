<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DestinationController;
use App\Models\Product;

// Halaman utama
Route::get('/', [HomeController::class, 'index']);

// Dashboard Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Halaman publik
Route::get('/destinasi', [DestinationController::class, 'index']);
Route::get('/destinasi/{id}', [DestinationController::class, 'show']);

Route::get('/toko', [StoreController::class, 'index']);

Route::get('/berita', function () {
    return 'Halaman Berita - coming soon';
});

// Halaman khusus Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Dashboard Admin - coming soon';
    });
});

// Halaman khusus Seller
Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', function () {
        return 'Dashboard Seller - coming soon';
    });
});

// Halaman untuk User yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', function () {
        return 'Halaman Keranjang - coming soon';
    });
});

require __DIR__.'/auth.php';