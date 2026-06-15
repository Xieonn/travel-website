<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        Destination::create([
            'name' => 'Gunung Kerinci',
            'description' => 'Gunung berapi tertinggi di Indonesia dengan ketinggian 3.805 mdpl. Menawarkan pemandangan kebun teh Kayu Aro yang memukau di kaki gunungnya, serta jalur pendakian yang menantang bagi para petualang yang mencari pengalaman tak terlupakan.',
            'location' => 'Kabupaten Kerinci, Jambi',
            'category' => 'Gunung',
            'latitude' => -1.696667, 
            'longitude' => 101.264167,
        ]);

        Destination::create([
            'name' => 'Danau Gunung Tujuh',
            'description' => 'Sering disebut sebagai danau para dewa, ini adalah danau kaldera tertinggi di Asia Tenggara yang dikelilingi oleh tujuh puncak gunung. Airnya yang tenang dan udara yang sangat sejuk menjadikan tempat ini surga tersembunyi bagi para pendaki.',
            'location' => 'Kabupaten Kerinci, Jambi',
            'category' => 'Danau',
            'latitude' => -1.7025,
            'longitude' => 101.4422,
        ]);

        Destination::create([
            'name' => 'Danau Kaco',
            'description' => 'Danau ajaib yang tersembunyi di rimbunnya Taman Nasional Kerinci Seblat (TNKS). Tempat ini sangat ikonik karena airnya yang berwarna biru jernih sebening kaca dan mitosnya dapat memancarkan cahaya terang di malam hari saat bulan purnama.',
            'location' => 'Lempur, Kabupaten Kerinci, Jambi',
            'category' => 'Danau',
            'latitude' => -2.030556,
            'longitude' => 101.554167,
        ]);
        Destination::create([
            'name' => 'Gunung Tujuh',
            'description' => 'Gunung Tujuh adalah gunung tidak aktif yang terletak di Desa Pelompek, Kabupaten Kerinci, Jambi. Terkenal dengan kaldera seluas 960 hektare di ketinggian 1.950 mdpl, tempat ini merupakan danau tertinggi di Asia Tenggara dan sering menjadi tujuan wisata pendakian.',
            'location' => 'Pesisir Bukit, Gunung Tujuh, Kabupaten Kerinci, Jambi',
            'category' => 'Gunung',
            'latitude' => -1.7025,
            'longitude' => 101.4422,
        ]);
        Destination::create([
            'name' => 'Gunung Masurai',
            'description' => 'Gunung Masurai terletak di kawasan konservasi Taman Nasional Kerinci Seblat. Merupakan sisa gunung api kompleks yang sangat luas dan besar dengan setengah kaldera tersisa di bagian timur. Di sebelah barat muncul dua kerucut, salah satunya memiliki dua buah danau vulkanik yaitu Danau Kumbang dan Danau Mabuk.',
            'location' => 'Renah Alai, Kec. Jangkat, Kabupaten Merangin, Jambi',
            'category' => 'Gunung',
            'latitude' => -2.4167,
            'longitude' => 101.9833,
        ]);
        Destination::create([
            'name' => 'Candi Muaro Jambi',
            'description' => 'Situs bersejarah yang wajib kamu kunjungi saat sedang berada di Jambi. Candi ini disebut-sebut sebagai candi terluas di Asia Tenggara dengan luas total kompleks mencapai 12 km persegi, atau sekitar 8 kali lebih luas dari Candi Borobudur. Kamu bisa menemukan beberapa candi sekaligus di tempat ini, seperti Candi Vando Astano, Candi Gumpung, Candi Tinggi, Candi Kembar Batu, Candi Gedong 1, Candi Gedong 2, dan kolam Talaga Rajo.',
            'location' => 'Desa Muara Jambi, Maro Sebo, Kabupaten Muaro Jambi, Jambi',
            'category' => 'Candi',
            'latitude' => -1.4731,
            'longitude' => 103.6686,
        ]);
    }
}