<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::create([
            'name' => 'Admin Travel',
            'email' => 'admin@travel.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        DB::table('posts')->insert([
            [
                'title' => 'Tips Traveling Hemat ke Bali',
                'content' => 'Bali selalu menjadi destinasi favorit wisatawan. Dengan perencanaan yang tepat, Anda bisa menikmati keindahan Bali tanpa menguras kantong.',
                'category' => 'Tips',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Keajaiban Bawah Laut Raja Ampat',
                'content' => 'Raja Ampat dikenal sebagai salah satu destinasi diving terbaik di dunia. Keanekaragaman hayati lautnya yang luar biasa menjadikannya surga bagi para penyelam.',
                'category' => 'Destinasi',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Panduan Mendaki Gunung Semeru',
                'content' => 'Gunung Semeru adalah puncak tertinggi di Pulau Jawa. Pendakian ke puncak Mahameru membutuhkan persiapan fisik dan mental yang matang.',
                'category' => 'Petualangan',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kuliner Wajib Coba di Yogyakarta',
                'content' => 'Yogyakarta bukan hanya terkenal dengan candi dan budayanya, tapi juga kulinernya yang lezat. Mulai dari gudeg, bakpia, hingga sate klathak.',
                'category' => 'Kuliner',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Menikmati Sunrise di Gunung Bromo',
                'content' => 'Pemandangan matahari terbit di Gunung Bromo adalah salah satu yang paling spektakuler di Indonesia.',
                'category' => 'Petualangan',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wisata Budaya di Yogyakarta',
                'content' => 'Yogyakarta menyimpan kekayaan budaya yang luar biasa. Dari Keraton, Candi Borobudur hingga Prambanan.',
                'category' => 'Budaya',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}