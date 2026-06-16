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
use App\Http\Controllers\Admin\UserController;
use App\Models\Product;

// --------------------------------------------------------
// HALAMAN PUBLIK (Bisa diakses tanpa login)
// --------------------------------------------------------
Route::get('/', [HomeController::class, 'index']);
Route::get('/destinasi', [DestinationController::class, 'index']);
Route::get('/destinasi/{id}', [DestinationController::class, 'show']);
Route::get('/toko', [StoreController::class, 'index']);
Route::get('/toko/{product}', [StoreController::class, 'show'])->name('products.show');

// Review produk (wajib login)
Route::middleware('auth')->group(function () {
    Route::post('/toko/{product}/review', [StoreController::class, 'storeReview'])->name('products.review.store');
    Route::delete('/toko/{product}/review', [StoreController::class, 'destroyReview'])->name('products.review.destroy');
});
Route::get('/tentang-kami', function () {return view('tentang-kami');});
Route::get('/layanan', function () {return view('layanan');});
Route::get('/kebijakan-privasi', function () {return view('kebijakan-privasi');});


// Midtrans Callback (Harus di luar Auth)
Route::post('/midtrans/callback', [PaymentNotificationController::class, 'handle']);

// --------------------------------------------------------
// HALAMAN USER (Wajib Login)
// --------------------------------------------------------
Route::middleware('auth')->group(function () {
    // Dashboard Utama User
    Route::get('/dashboard', function () {
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

    Route::get('/checkout/resume/{order_id}', [App\Http\Controllers\CheckoutController::class, 'resume'])->name('checkout.resume');

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
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Manajemen Destinasi
    Route::get('/destinasi', [App\Http\Controllers\DestinationController::class, 'adminIndex'])->name('destinasi.index');
    Route::get('/destinasi/create', [App\Http\Controllers\DestinationController::class, 'create'])->name('destinasi.create');
    Route::post('/destinasi', [App\Http\Controllers\DestinationController::class, 'store'])->name('destinasi.store');
    Route::get('/destinasi/{id}/edit', [App\Http\Controllers\DestinationController::class, 'edit'])->name('admin.destinasi.edit');
    Route::put('/destinasi/{id}', [App\Http\Controllers\DestinationController::class, 'update'])->name('destinasi.update');
    Route::delete('/destinasi/{id}', [App\Http\Controllers\DestinationController::class, 'destroy'])->name('destinasi.destroy');

    // Manajemen User
    Route::resource('users', UserController::class);

    // Manajemen Berita
    Route::get('/berita', [App\Http\Controllers\PostController::class, 'adminIndex'])->name('posts.index');
    Route::get('/berita/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('/berita', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::get('/berita/{id}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
    Route::put('/berita/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
    Route::delete('/berita/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
});

// --------------------------------------------------------
// HALAMAN KHUSUS SELLER
// --------------------------------------------------------
// Menggunakan kodemu dari branch Fitur-OutdoorStore karena lebih lengkap
Route::middleware(['auth', 'role:Seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::resource('products', App\Http\Controllers\Seller\ProductController::class);
});

require __DIR__.'/auth.php';