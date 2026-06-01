<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
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

Route::get('/toko', function () {
    $products = Product::latest()->take(8)->get();



    if ($products->isEmpty()) {

        $products = collect([

            // === ALAT HIKING ===

            (object)[

                'name' => 'The North Face Trailblazer 45L',

                'description' => 'ransel multifungsi berkapasitas besar, ideal untuk hiking, camping, dan aktivitas outdoor lainnya, terbuat dari bahan tahan lama Cordura dan polyester, serta dilengkapi ruang laptop dan kantong untuk botol air.',

                'price' => 2500000,

                'stock' => 10,

                'category' => 'hiking',

            ],

            (object)[

                'name' => 'Tenda The North Face Stormbreak',

                'description' => 'tenda ultralight dan tahan air untuk kegiatan camping, trekking, atau traveling dengan berbagai model dan kapasitas',

                'price' => 899000,

                'stock' => 12,

                'category' => 'hiking',

            ],

            (object)[

                'name' => 'Matras UltraLite',

                'description' => 'Matras empuk, ringkas, dan mudah dibawa untuk tidur nyaman di tenda.',

                'price' => 499000,

                'stock' => 24,

                'category' => 'hiking',

            ],

            (object)[

                'name' => 'Headlamp Adventure',

                'description' => 'Lampu kepala dengan cahaya terang, mode malam, dan baterai tahan lama.',

                'price' => 279000,

                'stock' => 35,

                'category' => 'hiking',

            ],

            (object)[

                'name' => 'Sleeping Bag The north Face EcoTrail',

                'description' => 'Kantong tidur premium dengan teknologi thermal, cocok untuk cuaca dingin ekstrim.',

                'price' => 1899000,

                'stock' => 10,

                'category' => 'hiking',

            ],

            (object)[

                'name' => 'Water Bottle Pro 1L',

                'description' => 'Botol air insulated dengan tampilan ergonomis, menjaga minuman tetap dingin hingga 24 jam.',

                'price' => 349000,

                'stock' => 50,

                'category' => 'hiking',

            ],

            // === PAKAIAN OUTDOOR ===

            (object)[

                'name' => 'The North Face Man Alta Vista Jacket',

                'description' => 'Menggunakan material 100% recycled DryVent yang sepenuhnya tahan air dan ramah lingkungan. Dilengkapi fitur pit-zip vents (resleting di ketiak) untuk membuang panas tubuh berlebih saat mendaki di cuaca basah, serta dapat dilipat masuk ke dalam saku dadanya sendiri',

                'price' => 4990000,

                'stock' => 22,

                'category' => 'pakaian',

            ],

            (object)[

                'name' => 'The North Face Man Paramount Convertible Pant',

                'description' => ' Celana multifungsi yang sangat populer. Dilengkapi teknologi FlashDry-XD™ untuk mempercepat penguapan keringat dan ketahanan kain yang ekstra. Menariknya, celana ini bisa diubah menjadi celana pendek 9 inci cukup dengan membuka resleting pada bagian lutut, sangat praktis saat suhu udara mulai panas di jalur pendakian.',

                'price' => 899000,

                'stock' => 30,

                'category' => 'pakaian',

            ],

            (object)[

                'name' => 'THE NORTH FACE S/S Bandana Square Logo Tee',

                'description' => 'Menggunakan perpaduan recycled polyester yang cepat kering dan katun berkualitas. Menghasilkan kaos bertekstur lembut dan lentur yang nyaman dipakai seharian di jalur pendakian, namun tetap modis dengan grafis logo kotak bermotif bandana di bagian belakang.',

                'price' => 649000,

                'stock' => 40,

                'category' => 'pakaian',

            ],

            (object)[

                'name' => 'The North Face Horizon Hat Unisex Water Resistant UV Care',

                'description' => 'Topi pet (cap) yang sangat ringan dan mudah dilipat ke dalam tas. Dilengkapi panel jaring ventilasi di sekeliling kepala untuk sirkulasi udara optimal, fitur water resistant, proteksi sinar ultraviolet (UPF 15-30), serta tali dagu yang bisa dilepas-pasang agar topi tidak terbang tertiup angin kencang di puncak gunung.',

                'price' => 299000,

                'stock' => 45,

                'category' => 'pakaian',

            ],

            (object)[

                'name' => 'Sarung Tangan Thermal',

                'description' => 'Sarung tangan outdoor dengan teknologi thermal insulation, touchscreen compatible, tahan air dan dingin.',

                'price' => 399000,

                'stock' => 28,

                'category' => 'pakaian',

            ],

            (object)[

                'name' => 'Sepatu Hiking The North Face Vectiv Taraval',

                'description' => 'Menggunakan teknologi VECTIV™ yang mengoptimalkan energi tolakan ke depan serta meredam benturan dengan sangat baik. Desain solnya yang bertekstur geometris dirancang untuk memberikan stabilitas tinggi di medan tanah maupun bebatuan lepas.',

                'price' => 4449000,

                'stock' => 35,

                'category' => 'pakaian',

            ],

        ]);

    }



    return view('outdoorstore', compact('products'));
});

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