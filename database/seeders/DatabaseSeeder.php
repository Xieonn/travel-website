<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {

        $this->call([
            RolePermissionSeeder::class,
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@travel.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('Admin');

        $seller = User::firstOrCreate(
            ['email' => 'seller@travel.com'],
            [
                'name' => 'Seller1',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $seller->assignRole('Seller');


        $this->call([
            DestinationSeeder::class,
            ProductSeeder::class,
            PostSeeder::class,
            
        ]);
    }
}