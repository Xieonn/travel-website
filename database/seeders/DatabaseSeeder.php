<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat role jika belum ada
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Seller']);
        Role::firstOrCreate(['name' => 'User']);

        // Buat akun Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@travel.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Admin');

        // Buat akun Seller
        $seller = User::firstOrCreate(
            ['email' => 'seller@travel.com'],
            [
                'name' => 'Seller1',
                'password' => Hash::make('password123'),
                'role' => 'seller',
                'email_verified_at' => now(),
            ]
        );
        $seller->assignRole('Seller');

        // Seed Destinasi saja (produk ditambahkan manual oleh seller)
        $this->call([
            DestinationSeeder::class,
        ]);
    }
}
