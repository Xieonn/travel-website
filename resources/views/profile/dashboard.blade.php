{{-- Menggunakan layout utama yang sudah Anda buat --}}
@extends('layouts.app')

@section('title', 'Dashboard')

{{-- Menambahkan CSS khusus hanya untuk halaman ini --}}
@push('styles')
<style>
    /* Elemen Tombol Kembali */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: #4A5568;
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 2rem;
        transition: color 0.2s ease;
    }

    .back-link:hover {
        color: var(--brand-ocean);
    }

    .back-link svg {
        width: 18px;
        height: 18px;
        transition: transform 0.2s ease;
    }

    .back-link:hover svg {
        transform: translateX(-4px); /* Efek animasi panah bergerak ke kiri */
    }

    /* Header Dashboard */
    .dashboard-header {
        margin-bottom: 3rem;
        text-align: center;
    }

    .dashboard-header h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        color: var(--brand-ocean);
        margin: 0 0 0.5rem 0;
    }

    .dashboard-header p {
        color: #4A5568;
        font-size: 1.1rem;
        margin: 0;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .feature-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(13, 59, 94, 0.04);
        border: 1px solid rgba(13, 59, 94, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(13, 59, 94, 0.08);
    }

    /* Aksen pita warna di bagian atas kartu */
    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--brand-sky);
    }

    .feature-card.admin-card::before { background: var(--brand-coral); }
    .feature-card.seller-card::before { background: var(--brand-sand); }

    .card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .icon-blue { background: rgba(26, 111, 168, 0.1); color: var(--brand-sky); }
    .icon-coral { background: rgba(217, 101, 74, 0.1); color: var(--brand-coral); }
    .icon-sand { background: rgba(232, 200, 125, 0.2); color: #B38F36; }

    .feature-card h3 {
        font-size: 1.25rem;
        color: var(--brand-ink);
        margin: 0 0 0.75rem 0;
    }

    .feature-card p {
        color: #718096;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0 0 1.5rem 0;
    }

    .card-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        color: var(--brand-ocean);
        transition: color 0.2s ease;
    }

    .card-btn:hover {
        color: var(--brand-sky);
    }

    .card-btn svg {
        width: 16px;
        height: 16px;
        transition: transform 0.2s ease;
    }

    .card-btn:hover svg {
        transform: translateX(4px);
    }
</style>
@endpush

@section('content')

    {{-- Tombol Kembali ke Beranda --}}
    <a href="/" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Beranda
    </a>

    <div class="dashboard-header">
        <h1>Selamat datang kembali, {{ auth()->user()->name ?? 'Pengunjung' }}!</h1>
        <p>Kelola aktivitas, destinasi, dan perjalanan Anda di satu tempat.</p>
    </div>

    <div class="grid-container">

        {{-- =======================================================
             MENU KHUSUS ADMIN 
        ======================================================== --}}
        @role('Admin')
        
        {{-- KARTU BARU YANG DITAMBAHKAN --}}
        <div class="feature-card admin-card">
            <div class="card-icon icon-coral">🏔️</div>
            <h3>Kelola Destinasi</h3>
            <p>Tambahkan destinasi wisata baru beserta deskripsi dan informasi lokasinya ke dalam sistem.</p>
            <a href="{{ route('admin.destinasi.create') }}" class="card-btn">
                Tambah Destinasi <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
        
        <div class="feature-card admin-card">
            <div class="card-icon icon-coral">👑</div>
            <h3>Kelola Pengguna</h3>
            <p>Pantau dan kelola seluruh akses pengguna, role, dan aktivitas di dalam platform travel ini.</p>
            <a href="/admin/users" class="card-btn">
                Buka Manajemen <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="feature-card admin-card">
            <div class="card-icon icon-coral">📊</div>
            <h3>Laporan Transaksi</h3>
            <p>Lihat ringkasan seluruh transaksi, pembayaran tiket, dan pendapatan dari toko suvenir.</p>
            <a href="/admin/transactions" class="card-btn">
                Lihat Laporan <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
        @endrole


        {{-- =======================================================
             MENU KHUSUS SELLER / PENJUAL 
        ======================================================== --}}
        @role('Seller')

        {{-- Stats Ringkasan Toko --}}
        @php
            $sellerProducts = \App\Models\Product::where('seller_id', auth()->id())->get();
            $totalProducts = $sellerProducts->count();
            $totalStock = $sellerProducts->sum('stock');
            $avgRating = $sellerProducts->count() > 0 ? number_format($sellerProducts->avg('rating'), 1) : '0.0';
        @endphp

        <div class="feature-card seller-card">
            <div class="card-icon icon-sand">📦</div>
            <h3 style="font-size:2.2rem; font-weight:700; color:var(--brand-ink); margin-bottom:0.2rem;">{{ $totalProducts }}</h3>
            <p style="margin:0;">Total Produk di Toko Anda</p>
        </div>

        <div class="feature-card seller-card">
            <div class="card-icon icon-sand">📊</div>
            <h3 style="font-size:2.2rem; font-weight:700; color:var(--brand-ink); margin-bottom:0.2rem;">{{ $totalStock }}</h3>
            <p style="margin:0;">Total Stok Tersedia</p>
        </div>

        <div class="feature-card seller-card">
            <div class="card-icon icon-sand">⭐</div>
            <h3 style="font-size:2.2rem; font-weight:700; color:var(--brand-ink); margin-bottom:0.2rem;">{{ $avgRating }}</h3>
            <p style="margin:0;">Rating Rata-rata Produk</p>
        </div>

        {{-- Aksi Seller --}}
        <div class="feature-card seller-card">
            <div class="card-icon icon-sand">🏪</div>
            <h3>Kelola Katalog Produk</h3>
            <p>Kelola etalase produk, perbarui stok barang, edit harga, dan lihat daftar produk toko Anda.</p>
            <a href="{{ route('seller.products.index') }}" class="card-btn">
                Kelola Toko <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="feature-card seller-card">
            <div class="card-icon icon-sand">➕</div>
            <h3>Tambah Produk Baru</h3>
            <p>Tambahkan produk baru ke etalase toko Anda lengkap dengan gambar, harga, dan deskripsi.</p>
            <a href="{{ route('seller.products.create') }}" class="card-btn">
                Tambah Produk <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="feature-card seller-card">
            <div class="card-icon icon-sand">👁️</div>
            <h3>Lihat Toko Publik</h3>
            <p>Lihat tampilan toko Anda seperti yang dilihat oleh pelanggan di halaman publik.</p>
            <a href="/toko" class="card-btn">
                Jelajahi Toko <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
        @endrole


        {{-- =======================================================
             MENU UMUM (Bisa diakses User, Admin, dan Seller) 
        ======================================================== --}}
        <div class="feature-card">
            <div class="card-icon icon-blue">🗺️</div>
            <h3>Destinasi Favorit</h3>
            <p>Temukan kembali tempat-tempat menakjubkan yang telah Anda simpan ke dalam daftar impian.</p>
            <a href="/destinasi" class="card-btn">
                Jelajahi <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="feature-card">
            <div class="card-icon icon-blue">🎟️</div>
            <h3>Riwayat Pembelian</h3>
            <p>Akses tiket e-boarding Anda dan ulas pengalaman liburan Anda sebelumnya bersama kami.</p>
            {{-- Menggunakan pemanggilan route yang sesuai dengan web.php --}}
            <a href="{{ route('transactions.history') }}" class="card-btn">
                Lihat Tiket <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="feature-card">
            <div class="card-icon icon-blue">⚙️</div>
            <h3>Pengaturan Akun</h3>
            <p>Perbarui informasi profil, ubah kata sandi, dan atur preferensi notifikasi email Anda.</p>
            {{-- Menggunakan pemanggilan route yang sesuai dengan web.php --}}
            <a href="{{ route('profile.edit') }}" class="card-btn">
                Atur Profil <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
@endsection