<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentNotificationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PostController;
use App\Models\Product;

// --------------------------------------------------------
// HALAMAN PUBLIK (Bisa diakses tanpa login)
// --------------------------------------------------------
Route::get('/', [HomeController::class, 'index']);
Route::get('/destinasi', [DestinationController::class, 'index']);
Route::get('/destinasi/{id}', [DestinationController::class, 'show']);
Route::get('/toko', [StoreController::class, 'index']);
Route::get('/berita', function () {
    return 'Halaman Berita - coming soon';
});

// Midtrans Callback (Harus di luar Auth)
Route::post('/midtrans/callback', [PaymentNotificationController::class, 'handle']);

// --------------------------------------------------------
// HALAMAN USER (Wajib Login)
// --------------------------------------------------------
Route::middleware('auth')->group(function () {
    // Dashboard Utama User
    Route::get('/dashboard', function () {
        // Pastikan file view ada di resources/views/profile/dashboard.blade.php
        return view('profile.dashboard'); 
    })->name('dashboard');

    // Profile Management (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menu Umum Dashboard
    Route::get('/user/destinasi/favorit', function () {
        return 'Halaman Destinasi Favorit - coming soon';
    });
    
    // Transaksi & Keranjang
    Route::get('/keranjang', function () {
        return 'Halaman Keranjang - coming soon';
    });

    // Halaman berita
    Route::get('/berita', [PostController::class, 'index']);
    Route::get('/berita/{id}', [PostController::class, 'show']);
    
    Route::get('/riwayat-transaksi', [TransactionController::class, 'index'])->name('transactions.history');
});

// Proses yang butuh verifikasi email ekstra (Keamanan Tambahan)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

// --------------------------------------------------------
// HALAMAN KHUSUS ADMIN
// --------------------------------------------------------
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Dashboard Admin - coming soon';
    });

    // Pastikan 2 baris ini ada dan tidak ada salah ketik (typo)
    Route::get('/destinasi/tambah', [DestinationController::class, 'create'])->name('admin.destinasi.create');
    Route::post('/destinasi', [DestinationController::class, 'store'])->name('admin.destinasi.store');

    Route::delete('/destinasi/{id}', [DestinationController::class, 'destroy'])->name('admin.destinasi.destroy');
    });    

    // ... rute create, store, dan destroy sebelumnya ...
    
    // Rute untuk fitur Edit
    Route::get('/destinasi/{id}/edit', [DestinationController::class, 'edit'])->name('admin.destinasi.edit');
    Route::put('/destinasi/{id}', [DestinationController::class, 'update'])->name('admin.destinasi.update');
    
// --------------------------------------------------------
// HALAMAN KHUSUS SELLER
// --------------------------------------------------------
Route::middleware(['auth', 'role:Seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', function () {
        return 'Dashboard Seller - coming soon';
    });
    
    // Nanti rute untuk mengelola toko/produk letakkan di sini.
});

require __DIR__.'/auth.php';