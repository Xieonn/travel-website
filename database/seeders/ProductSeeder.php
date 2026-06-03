<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // === ALAT HIKING ===
            [
                'name' => 'The North Face Trailblazer 45L',
                'description' => 'Ransel multifungsi berkapasitas besar, ideal untuk hiking, camping, dan aktivitas outdoor lainnya, terbuat dari bahan tahan lama Cordura dan polyester, serta dilengkapi ruang laptop dan kantong untuk botol air.',
                'price' => 2500000,
                'stock' => 10,
                'category' => 'Alat hiking',
            ],
            [
                'name' => 'Tenda The North Face Stormbreak',
                'description' => 'Tenda ultralight dan tahan air untuk kegiatan camping, trekking, atau traveling dengan berbagai model dan kapasitas.',
                'price' => 899000,
                'stock' => 12,
                'category' => 'Alat hiking',
            ],
            [
                'name' => 'Matras UltraLite',
                'description' => 'Matras empuk, ringkas, dan mudah dibawa untuk tidur nyaman di tenda.',
                'price' => 499000,
                'stock' => 24,
                'category' => 'Alat hiking',
            ],
            [
                'name' => 'Headlamp Adventure',
                'description' => 'Lampu kepala dengan cahaya terang, mode malam, dan baterai tahan lama.',
                'price' => 279000,
                'stock' => 35,
                'category' => 'Alat hiking',
            ],
            [
                'name' => 'Sleeping Bag The North Face EcoTrail',
                'description' => 'Kantong tidur premium dengan teknologi thermal, cocok untuk cuaca dingin ekstrim.',
                'price' => 1899000,
                'stock' => 10,
                'category' => 'Alat hiking',
            ],
            [
                'name' => 'Water Bottle Pro 1L',
                'description' => 'Botol air insulated dengan tampilan ergonomis, menjaga minuman tetap dingin hingga 24 jam.',
                'price' => 349000,
                'stock' => 50,
                'category' => 'Alat hiking',
            ],

            // === PAKAIAN OUTDOOR ===
            [
                'name' => 'The North Face Man Alta Vista Jacket',
                'description' => 'Menggunakan material 100% recycled DryVent yang sepenuhnya tahan air dan ramah lingkungan. Dilengkapi fitur pit-zip vents (resleting di ketiak) untuk membuang panas tubuh berlebih saat mendaki di cuaca basah, serta dapat dilipat masuk ke dalam saku dadanya sendiri.',
                'price' => 4990000,
                'stock' => 22,
                'category' => 'pakaian',
            ],
            [
                'name' => 'The North Face Man Paramount Convertible Pant',
                'description' => 'Celana multifungsi yang sangat populer. Dilengkapi teknologi FlashDry-XD™ untuk mempercepat penguapan keringat dan ketahanan kain yang ekstra. Menariknya, celana ini bisa diubah menjadi celana pendek 9 inci cukup dengan membuka resleting pada bagian lutut.',
                'price' => 899000,
                'stock' => 30,
                'category' => 'pakaian',
            ],
            [
                'name' => 'THE NORTH FACE S/S Bandana Square Logo Tee',
                'description' => 'Menggunakan perpaduan recycled polyester yang cepat kering dan katun berkualitas. Menghasilkan kaos bertekstur lembut dan lentur yang nyaman dipakai seharian di jalur pendakian, namun tetap modis.',
                'price' => 649000,
                'stock' => 40,
                'category' => 'pakaian',
            ],
            [
                'name' => 'The North Face Horizon Hat Unisex Water Resistant UV Care',
                'description' => 'Topi pet (cap) yang sangat ringan dan mudah dilipat ke dalam tas. Dilengkapi panel jaring ventilasi di sekeliling kepala untuk sirkulasi udara optimal, fitur water resistant, proteksi sinar ultraviolet (UPF 15-30).',
                'price' => 299000,
                'stock' => 45,
                'category' => 'pakaian',
            ],
            [
                'name' => 'Sarung Tangan Thermal',
                'description' => 'Sarung tangan outdoor dengan teknologi thermal insulation, touchscreen compatible, tahan air dan dingin.',
                'price' => 399000,
                'stock' => 28,
                'category' => 'pakaian',
            ],
            [
                'name' => 'Sepatu Hiking The North Face Vectiv Taraval',
                'description' => 'Menggunakan teknologi VECTIV™ yang mengoptimalkan energi tolakan ke depan serta meredam benturan dengan sangat baik. Desain solnya bertekstur geometris untuk stabilitas tinggi di medan tanah maupun bebatuan.',
                'price' => 4449000,
                'stock' => 35,
                'category' => 'pakaian',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}