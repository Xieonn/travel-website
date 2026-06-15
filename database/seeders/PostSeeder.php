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
                'title' => 'Tips Healling ke Gunung Dengan Budget Terbatas',
                'content' => 'Berikut adalah beberapa tips untuk melakukan healing ke gunung dengan budget yang terbatas:',
                'category' => 'Tips',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Keindahan Pemandangan dari Puncak Gunung',
                'content' => 'Pemandangan dari puncak gunung sangat memukau dan memberikan sensasi yang luar biasa. Berikut adalah beberapa tempat gunung yang wajib dikunjungi:',
                'category' => 'Destinasi',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Panduan Mendaki Gunung untuk Pemula',
                'content' => 'Mendaki gunung bisa menjadi pengalaman yang menyenangkan dan menantang. Berikut adalah panduan untuk pemula yang ingin mencoba mendaki gunung:',
                'category' => 'Petualangan',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pemandangan Danau yang Menakjubkan di Sekitar Gunung',
                'content' => 'Danau-danau di sekitar gunung sering kali menawarkan pemandangan yang memukau dan suasana yang tenang. Berikut adalah beberapa danau yang wajib dikunjungi:',
                'category' => 'Destinasi',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Menikmati Sunrise di Gunung',
                'content' => 'Penikmatan sunrise di gunung adalah pengalaman yang luar biasa. Berikut adalah beberapa tips untuk menikmati sunrise di gunung dengan sempurna:',
                'category' => 'Petualangan',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wisata Bersejarah di Jambi',
                'content' => 'Jambi memiliki banyak situs bersejarah yang menarik untuk dikunjungi. Mulai dari candi-candi kuno hingga istana-istana kerajaan yang dulu pernah berdiri.',
                'category' => 'Budaya',
                'image' => null,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}