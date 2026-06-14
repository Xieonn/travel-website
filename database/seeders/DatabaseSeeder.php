<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; // Dari kodemu (Fitur-OutdoorStore)
use App\Models\User;               // Dari kode temanmu (main)

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. DARI KODEMU: Buat role jika belum ada
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Seller']);
        Role::firstOrCreate(['name' => 'User']);

        // 2. DARI KODE TEMANMU: Memanggil RolePermissionSeeder
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // 3. GABUNGAN: Buat akun Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@travel.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin', // Atribut tambahan dari kodemu
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Admin');

        // 4. GABUNGAN: Buat akun Seller
        $seller = User::firstOrCreate(
            ['email' => 'seller@travel.com'],
            [
                'name' => 'Seller1',
                'password' => Hash::make('password123'),
                'role' => 'seller', // Atribut tambahan dari kodemu
                'email_verified_at' => now(),
            ]
        );
        $seller->assignRole('Seller');

        // 5. GABUNGAN: Panggil semua seeder
        $this->call([
            DestinationSeeder::class, // Ada di kodemu & kode temanmu
            ProductSeeder::class,     // Dari kode temanmu
            PostSeeder::class,        // Dari kode temanmu
        ]);
    }
}