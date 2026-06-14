<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions (wajib dilakukan setiap seeding Spatie)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Definisikan semua Permission yang ada di tabel
        $permissions = [
            // Navigasi Utama
            'akses penuh halaman utama',
            'mengelola destinasi', 'akses penuh destinasi', 'melihat destinasi',
            'mengelola cart', 'akses penuh cart', 'terbatas cart',
            'mengelola shop', 'akses penuh shop',

            // Konten dan Informasi
            'mengelola tentang kami', 'melihat tentang kami',
            'mengelola berita', 'melihat berita',
            'mengelola customer service', 'akses penuh customer service', 'terbatas customer service',

            // Akun dan Autentikasi
            'akses penuh sign in out',
            'akses penuh sign up',

            // Manajemen (Pengelolaan)
            'akses penuh dashboard admin',
            'mengelola pengguna', 
            'mengelola produk', 'terbatas produk',
            'akses penuh transaksi', 'melihat transaksi', 'terbatas transaksi',
        ];

        // Buat permission di database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Buat Roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $sellerRole = Role::firstOrCreate(['name' => 'Seller']);

        // 3. Assign Permissions ke masing-masing Role (Berdasarkan Tabel)

        // --- ADMIN ---
        $adminRole->syncPermissions([
            'akses penuh halaman utama', 'mengelola destinasi', 'mengelola cart', 'mengelola shop',
            'mengelola tentang kami', 'mengelola berita', 'mengelola customer service',
            'akses penuh sign in out', 'akses penuh dashboard admin', 'mengelola pengguna',
            'mengelola produk', 'akses penuh transaksi'
        ]);

        // --- USER ---
        $userRole->syncPermissions([
            'akses penuh halaman utama', 'akses penuh destinasi', 'akses penuh cart', 'akses penuh shop',
            'melihat tentang kami', 'melihat berita', 'akses penuh customer service',
            'akses penuh sign in out', 'akses penuh sign up', 'melihat transaksi'
        ]);

        // --- SELLER ---
        $sellerRole->syncPermissions([
            'akses penuh halaman utama', 'melihat destinasi', 'terbatas cart', 'mengelola shop',
            'melihat tentang kami', 'melihat berita', 'terbatas customer service',
            'akses penuh sign in out', 'akses penuh sign up', 'mengelola pengguna',
            'terbatas produk', 'terbatas transaksi'
        ]);
    }
}