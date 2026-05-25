<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Destination::insert([
            [
                'name' => 'Bali',
                'description' => 'Pulau dewata yang terkenal dengan keindahan pantai, budaya, dan kuliner khasnya.',
                'location' => 'Bali, Indonesia',
                'category' => 'Pantai',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Raja Ampat',
                'description' => 'Surga bawah laut dengan keanekaragaman hayati laut yang luar biasa.',
                'location' => 'Papua Barat, Indonesia',
                'category' => 'Bahari',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bromo',
                'description' => 'Gunung berapi aktif dengan pemandangan matahari terbit yang memukau.',
                'location' => 'Jawa Timur, Indonesia',
                'category' => 'Gunung',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Labuan Bajo',
                'description' => 'Gerbang menuju Pulau Komodo dengan pemandangan laut yang spektakuler.',
                'location' => 'NTT, Indonesia',
                'category' => 'Bahari',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yogyakarta',
                'description' => 'Kota budaya dengan Candi Borobudur, Prambanan, dan kuliner legendaris.',
                'location' => 'DIY, Indonesia',
                'category' => 'Budaya',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Danau Toba',
                'description' => 'Danau vulkanik terbesar di dunia dengan keindahan alam yang menakjubkan.',
                'location' => 'Sumatera Utara, Indonesia',
                'category' => 'Danau',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gunung Rinjani',
                'description' => 'Gunung berapi tertinggi kedua di Indonesia dengan danau kawah Segara Anak yang memukau.',
                'location' => 'Lombok, NTB',
                'category' => 'Gunung',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
        ],
        [
            'name' => 'Gunung Semeru',
            'description' => 'Puncak tertinggi di Pulau Jawa, dikenal dengan jalur pendakian menantang dan pemandangan epik.',
            'location' => 'Jawa Timur, Indonesia',
            'category' => 'Gunung',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Gunung Papandayan',
            'description' => 'Gunung berapi aktif dengan kawah belerang, hutan mati, dan padang edelweiss yang indah.',
            'location' => 'Garut, Jawa Barat',
            'category' => 'Gunung',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Gunung Merbabu',
            'description' => 'Gunung dengan jalur pendakian yang ramah untuk pemula, menawarkan pemandangan alam yang memesona.',
            'location' => 'Jawa Tengah, Indonesia',
            'category' => 'Gunung',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        ]);
    }
}   
