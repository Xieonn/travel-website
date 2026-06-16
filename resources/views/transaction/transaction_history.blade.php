@extends('layouts.app')

@section('title', 'Riwayat Pembelian')

@push('styles')
<style>
    /* ── HISTORY PAGE HEADER ────────────────────────────────── */
    .history-header {
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .history-header h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        color: var(--brand-ocean);
        margin: 0 0 0.5rem;
        letter-spacing: -0.02em;
    }

    .history-header p {
        color: #4A5568;
        font-size: 1rem;
        margin: 0;
    }

    /* ── BACK LINK ───────────────────────────────────────────── */
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
        transform: translateX(-4px);
    }

    /* ── TRANSACTION CARDS ───────────────────────────────────── */
    .history-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .order-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13, 59, 94, 0.04);
        border: 1px solid rgba(13, 59, 94, 0.06);
        margin-bottom: 2rem;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .order-card:hover {
        box-shadow: 0 8px 32px rgba(13, 59, 94, 0.08);
    }

    .order-header {
        background-color: var(--brand-mist);
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(13, 59, 94, 0.06);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-id-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .order-id {
        font-weight: 600;
        color: var(--brand-ocean);
        font-size: 1.05rem;
    }

    .order-date {
        font-size: 0.85rem;
        color: #718096;
    }

    /* ── STATUS BADGES ───────────────────────────────────────── */
    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.775rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-pending {
        background-color: rgba(217, 119, 6, 0.1);
        color: #B45309;
        border: 1px solid rgba(217, 119, 6, 0.2);
    }

    .status-paid {
        background-color: rgba(6, 95, 70, 0.1);
        color: #065F46;
        border: 1px solid rgba(6, 95, 70, 0.2);
    }

    .status-cancelled {
        background-color: rgba(153, 27, 27, 0.1);
        color: #991B1B;
        border: 1px solid rgba(153, 27, 27, 0.2);
    }

    /* ── ORDER BODY & ITEMS ──────────────────────────────────── */
    .order-body {
        padding: 0 1.5rem;
    }

    .product-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 0;
        border-bottom: 1px solid rgba(13, 59, 94, 0.06);
    }

    .product-row:last-child {
        border-bottom: none;
    }

    .product-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .product-name {
        font-weight: 500;
        color: var(--brand-ink);
        font-size: 1rem;
    }

    .product-qty {
        font-size: 0.85rem;
        color: #718096;
    }

    .product-price {
        font-weight: 500;
        color: var(--brand-ink);
        font-size: 0.95rem;
    }

    /* ── RESUME BUTTON ───────────────────────────────────────── */
    .btn-resume {
        display: inline-block;
        background-color: var(--brand-ocean, #0369a1);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .btn-resume:hover {
        background-color: var(--brand-sky, #0284c7);
        color: white;
    }

    /* ── ORDER FOOTER ────────────────────────────────────────── */
    .order-footer {
        background-color: #FAFCFE;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(13, 59, 94, 0.06);
    }

    .total-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #4A5568;
    }

    .total-amount {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--brand-sky);
    }

    /* ── EMPTY STATE ─────────────────────────────────────────── */
    .empty-state {
        text-align: center;
        background: white;
        padding: 4rem 2rem;
        border-radius: 16px;
        border: 1px dashed rgba(13, 59, 94, 0.2);
        color: #718096;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1.5rem;
        color: var(--brand-sky);
        opacity: 0.5;
    }

    .empty-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.75rem;
        color: var(--brand-ocean);
        margin: 0 0 0.5rem;
    }

    .btn-shop {
        display: inline-block;
        margin-top: 1.5rem;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        color: white;
        background: var(--brand-ocean);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        transition: background 0.2s, transform 0.15s;
    }

    .btn-shop:hover {
        background: var(--brand-sky);
        transform: translateY(-1px);
    }

    @media (max-width: 600px) {
        .order-header { flex-direction: column; align-items: flex-start; }
        .product-row { flex-direction: column; align-items: flex-start; gap: 10px; }
        .product-price { align-self: flex-end; }
    }
</style>
@endpush

@section('content')
<div class="history-container">
    
    {{-- Tombol Kembali ke Dashboard --}}
    <a href="{{ route('dashboard') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Dashboard
    </a>

    <div class="history-header">
        <h1>Riwayat Pembelian</h1>
        <p>Kelola dan pantau seluruh transaksi tiket dan suvenir Anda.</p>
    </div>

    @if($transactions->isEmpty())
        {{-- EMPTY STATE (Jika belum ada transaksi) --}}
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <h2 class="empty-title">Belum Ada Transaksi</h2>
            <p>Sepertinya Anda belum memesan tiket destinasi atau membeli suvenir apa pun.</p>
            <a href="/toko" class="btn-shop">Mulai Jelajah Toko</a>
        </div>
    @else
        {{-- DAFTAR TRANSAKSI --}}
        @foreach($transactions->groupBy('order_id') as $orderId => $items)
            @php 
                // Mengambil item pertama sebagai perwakilan grup
                $firstItem = $items->first(); 
                // Menghitung total harga keseluruhan dari grup order_id ini
                $totalOrderPrice = $items->sum('total_price');
            @endphp

            <div class="order-card">
                
                {{-- Bagian Header Kartu --}}
                <div class="order-header">
                    <div class="order-id-group">
                        <span class="order-id">#{{ $orderId }}</span>
                        <div class="order-date">{{ $firstItem->created_at->format('d M Y • H:i') }} WIB</div>
                    </div>
                    
                    @if($firstItem->status === 'pending')
                        <span class="status-badge status-pending">Menunggu Pembayaran</span>
                    @elseif($firstItem->status === 'paid')
                        <span class="status-badge status-paid">Lunas</span>
                    @else
                        <span class="status-badge status-cancelled">Dibatalkan</span>
                    @endif
                </div>

                {{-- Bagian Daftar Produk --}}
                <div class="order-body">
                    @foreach($items as $item)
                        <div class="product-row">
                            <div class="product-info">
                                {{-- Menampilkan nama produk lewat relasi model --}}
                                <span class="product-name">{{ $item->product->name ?? 'Produk Tidak Tersedia' }}</span>
                                <span class="product-qty">{{ $item->quantity }}x @ Rp {{ number_format($item->total_price / $item->quantity, 0, ',', '.') }}</span>
                            </div>
                            <div class="product-price">
                                Rp {{ number_format($item->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Bagian Total dan Aksi Tambahan --}}
                <div class="order-footer">
                    <div>
                        <span class="total-label">Total Pembayaran:</span><br>
                        <span class="total-amount">Rp {{ number_format($totalOrderPrice, 0, ',', '.') }}</span>
                    </div>
                    
                    {{-- Tombol Lanjutkan Pembayaran (Hanya muncul jika Pending) --}}
                    @if($firstItem->status === 'pending')
                        <a href="{{ route('checkout.resume', $orderId) }}" class="btn-resume">
                            Lanjutkan Pembayaran
                        </a>
                    @endif
                </div>
                
            </div>
        @endforeach
    @endif

</div>
@endsection