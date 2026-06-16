<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Cari seller pertama untuk dijadikan pemilik produk
        $seller = User::role('seller')->first();

        $products = [
            // === 4 PRODUK DENGAN GAMBAR ASLI ===
            [
                'name'        => 'The North Face Trailblazer 45L',
                'description' => 'Ransel multifungsi berkapasitas 45L, ideal untuk hiking dan camping, terbuat dari bahan tahan lama Cordura dan polyester, dilengkapi ruang laptop dan kantong botol air.',
                'price'       => 2500000,
                'stock'       => 10,
                'category'    => 'Carrier',
                'image'       => 'terra45.webp',
            ],
            [
                'name'        => 'Tenda The North Face Stormbreak',
                'description' => 'Tenda ultralight dan tahan air untuk camping, trekking, atau traveling di berbagai kondisi cuaca.',
                'price'       => 899000,
                'stock'       => 12,
                'category'    => 'Tenda',
                'image'       => 'tenda.webp',
            ],
            [
                'name'        => 'The North Face Man Alta Vista Jacket',
                'description' => 'Jaket outdoor dari material 100% recycled DryVent yang sepenuhnya tahan air dan ramah lingkungan.',
                'price'       => 4990000,
                'stock'       => 22,
                'category'    => 'Jaket',
                'image'       => 'jaket.webp',
            ],
            [
                'name'        => 'Sepatu Hiking The North Face Vectiv Taraval',
                'description' => 'Sepatu hiking dengan teknologi VECTIV™ yang mengoptimalkan energi tolakan dan meredam benturan di medan apapun.',
                'price'       => 4449000,
                'stock'       => 35,
                'category'    => 'Sepatu',
                'image'       => 'vectiv.webp',
            ],
        ];

        foreach ($products as $product) {
            // updateOrCreate: cari berdasarkan nama, update jika ada, buat baru jika tidak ada
            // Sehingga menjalankan seeder berulang kali tidak membuat duplikat
            Product::updateOrCreate(
                ['name' => $product['name']],
                array_merge($product, [
                    'seller_id'  => $seller?->id,
                    'rating'     => 0,
                    'sold_count' => 0,
                ])
            );
        }
    }
}