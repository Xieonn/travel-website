@extends('layouts.app')

@section('title', 'Seller Dashboard')

@push('styles')
<style>
    .seller-dashboard {
        max-width: 1100px;
        margin: 0 auto;
    }

    .seller-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .seller-header h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.2rem;
        font-weight: 600;
        color: var(--brand-ocean);
        margin: 0 0 0.5rem;
    }

    .seller-header p {
        color: #64748b;
        font-size: 0.95rem;
    }

    /* Stats Cards */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 1.5rem;
        border: 1px solid rgba(13,59,94,0.06);
        box-shadow: 0 2px 12px rgba(13,59,94,0.04);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(13,59,94,0.08);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.3rem;
    }

    .stat-icon.blue { background: rgba(26,111,168,0.1); color: var(--brand-sky); }
    .stat-icon.green { background: rgba(16,185,129,0.1); color: #10b981; }
    .stat-icon.amber { background: rgba(245,158,11,0.1); color: #f59e0b; }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--brand-ink);
        line-height: 1;
        margin-bottom: 0.3rem;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Action Cards */
    .action-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .action-card {
        background: white;
        border-radius: 14px;
        padding: 1.75rem;
        border: 1px solid rgba(13,59,94,0.06);
        box-shadow: 0 2px 12px rgba(13,59,94,0.04);
        text-decoration: none;
        color: inherit;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(13,59,94,0.1);
    }

    .action-card .action-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .action-card .action-icon.primary { background: linear-gradient(135deg, var(--brand-sky), var(--brand-ocean)); color: white; }
    .action-card .action-icon.success { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .action-card .action-icon.warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }

    .action-card h3 {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--brand-ink);
        margin: 0;
    }

    .action-card p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }

    .action-link {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--brand-sky);
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: auto;
    }

    @media (max-width: 768px) {
        .stats-row, .action-row { grid-template-columns: 1fr; }
        .seller-header h1 { font-size: 1.6rem; }
    }
</style>
@endpush

@section('content')
<div class="seller-dashboard">

    <div class="seller-header">
        <h1>Selamat datang kembali, {{ Auth::user()->name }}!</h1>
        <p>Kelola produk, etalase, dan performa toko Anda di sini.</p>
    </div>

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon blue">📦</div>
            <div class="stat-value">{{ $totalProducts }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">📊</div>
            <div class="stat-value">{{ $totalStock }}</div>
            <div class="stat-label">Total Stok</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon amber">⭐</div>
            <div class="stat-value">{{ number_format($avgRating, 1) }}</div>
            <div class="stat-label">Rating Rata-rata</div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="action-row">
        <a href="{{ route('seller.products.index') }}" class="action-card">
            <div class="action-icon primary">🏪</div>
            <h3>Toko Suvenir Saya</h3>
            <p>Kelola etalase produk, perbarui stok barang, dan lihat ulasan dari pelanggan Anda.</p>
            <span class="action-link">Kelola Toko →</span>
        </a>

        <a href="{{ route('seller.products.create') }}" class="action-card">
            <div class="action-icon success">➕</div>
            <h3>Tambah Produk Baru</h3>
            <p>Tambahkan produk baru ke etalase toko Anda lengkap dengan gambar dan deskripsi.</p>
            <span class="action-link">Tambah Produk →</span>
        </a>

        <a href="/toko" class="action-card">
            <div class="action-icon warning">🌍</div>
            <h3>Lihat Toko Publik</h3>
            <p>Lihat tampilan toko seperti yang dilihat oleh pelanggan Anda.</p>
            <span class="action-link">Jelajahi →</span>
        </a>
    </div>

</div>
@endsection
