@extends('layouts.app')

@section('title', 'Kelola Produk - Seller')

@push('styles')
<style>
    .seller-products {
        max-width: 1100px;
        margin: 0 auto;
    }

    .page-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-top h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--brand-ocean);
        margin: 0;
    }

    .btn-add-product {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, var(--brand-sky), var(--brand-ocean));
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.6rem 1.4rem;
        border-radius: 10px;
        text-decoration: none;
        transition: transform 0.15s, box-shadow 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-add-product:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(26,111,168,0.3);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: background 0.2s, color 0.2s;
    }

    .btn-back:hover {
        background: rgba(13,59,94,0.06);
        color: var(--brand-ocean);
    }

    /* Alert */
    .alert-success {
        background: rgba(16,185,129,0.08);
        border: 1px solid rgba(16,185,129,0.25);
        color: #065F46;
        padding: 0.875rem 1.25rem;
        border-radius: 10px;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Product Table */
    .product-table-wrap {
        background: white;
        border-radius: 14px;
        border: 1px solid rgba(13,59,94,0.06);
        box-shadow: 0 2px 12px rgba(13,59,94,0.04);
        overflow: hidden;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
    }

    .product-table thead {
        background: var(--brand-mist);
    }

    .product-table th {
        padding: 0.85rem 1.25rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #64748b;
        border-bottom: 1px solid rgba(13,59,94,0.08);
    }

    .product-table td {
        padding: 1rem 1.25rem;
        font-size: 0.875rem;
        color: var(--brand-ink);
        border-bottom: 1px solid rgba(13,59,94,0.05);
        vertical-align: middle;
    }

    .product-table tbody tr:hover {
        background: rgba(26,111,168,0.02);
    }

    .product-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-img-cell {
        width: 64px;
    }

    .product-img-cell img {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid rgba(13,59,94,0.08);
    }

    .product-img-placeholder {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        background: var(--brand-mist);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 0.7rem;
    }

    .product-name-cell strong {
        display: block;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .product-name-cell .meta {
        font-size: 0.78rem;
        color: #94a3b8;
    }

    .rating-badge {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #f59e0b;
    }

    .action-btns {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .btn-edit {
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--brand-sky);
        text-decoration: none;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        border: 1px solid rgba(26,111,168,0.2);
        transition: background 0.2s;
    }

    .btn-edit:hover {
        background: rgba(26,111,168,0.08);
    }

    .btn-delete {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--brand-coral);
        background: none;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        border: 1px solid rgba(217,101,74,0.2);
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-delete:hover {
        background: rgba(217,101,74,0.08);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #94a3b8;
    }

    .empty-state h3 {
        font-size: 1.1rem;
        color: #64748b;
        margin: 0 0 0.5rem;
    }

    .empty-state p {
        font-size: 0.875rem;
        margin: 0 0 1.5rem;
    }

    @media (max-width: 768px) {
        .product-table th:nth-child(3),
        .product-table td:nth-child(3),
        .product-table th:nth-child(5),
        .product-table td:nth-child(5) { display: none; }
    }
</style>
@endpush

@section('content')
<div class="seller-products">

    <div class="page-top">
        <div>
            <a href="{{ route('seller.dashboard') }}" class="btn-back">← Dashboard</a>
            <h1>Katalog Produk Toko</h1>
        </div>
        <a href="{{ route('seller.products.create') }}" class="btn-add-product">+ Tambah Produk</a>
    </div>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="product-table-wrap">
        @if($products->count() > 0)
        <table class="product-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="product-img-cell">
                        @if($product->image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div class="product-img-placeholder">No Img</div>
                        @endif
                    </td>
                    <td class="product-name-cell">
                        <strong>{{ $product->name }}</strong>
                        <span class="meta">Terjual: {{ $product->sold_count }}</span>
                    </td>
                    <td>{{ $product->category ?? '-' }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <span class="rating-badge">★ {{ number_format($product->rating, 1) }}</span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('seller.products.edit', $product) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('seller.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <h3>Belum ada produk</h3>
            <p>Mulai tambahkan produk ke etalase toko Anda.</p>
            <a href="{{ route('seller.products.create') }}" class="btn-add-product">+ Tambah Produk Pertama</a>
        </div>
        @endif
    </div>

</div>
@endsection
