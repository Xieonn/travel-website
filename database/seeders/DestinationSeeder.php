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
    }
}