@extends('layouts.app')

@section('title', $product->name . ' - Toko Outdoor')

@push('styles')
<style>
    /* ── Variables ── */
    :root {
        --pd-ink: #1a1a1a;
        --pd-muted: #666;
        --pd-border: #e5e5e5;
        --pd-gold: #e58b35;
        --pd-blue: #1A6FA8;
        --pd-green: #10b981;
        --pd-red: #ef4444;
        --pd-bg: #fafafa;
        --pd-radius: 12px;
        --pd-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    }

    .pd-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Breadcrumb */
    .pd-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: var(--pd-muted);
        margin-bottom: 1.75rem;
    }

    .pd-breadcrumb a {
        color: var(--pd-muted);
        text-decoration: none;
    }

    .pd-breadcrumb a:hover {
        color: var(--pd-blue);
    }

    .pd-breadcrumb span {
        color: var(--pd-ink);
        font-weight: 500;
    }

    /* ── TOP SECTION ── */
    .pd-top {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }

    /* Image Panel */
    .pd-image-panel {
        position: relative;
    }

    .pd-main-image {
        width: 100%;
        aspect-ratio: 1/1;
        border-radius: var(--pd-radius);
        background: var(--pd-bg);
        border: 1px solid var(--pd-border);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pd-main-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 1rem;
    }

    /* Info Panel */
    .pd-info-panel {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .pd-category-tags {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pd-tag {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 999px;
        border: 1px solid var(--pd-border);
        color: var(--pd-muted);
        background: var(--pd-bg);
    }

    .pd-name {
        font-size: 1.85rem;
        font-weight: 800;
        line-height: 1.2;
        color: var(--pd-ink);
        margin: 0;
    }

    .pd-rating-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pd-stars {
        display: flex;
        gap: 2px;
    }

    .pd-stars .star {
        font-size: 1.1rem;
        color: #ddd;
    }

    .pd-stars .star.filled {
        color: var(--pd-gold);
    }

    .pd-stars .star.half {
        color: var(--pd-gold);
    }

    .pd-avg-num {
        font-size: 1rem;
        font-weight: 700;
        color: var(--pd-ink);
    }

    .pd-review-count {
        font-size: 0.85rem;
        color: var(--pd-muted);
    }

    .pd-price {
        font-size: 2rem;
        font-weight: 800;
        color: var(--pd-ink);
        margin: 0;
    }

    .pd-meta-row {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .pd-meta-item {
        display: flex;
        gap: 8px;
        font-size: 0.875rem;
    }

    .pd-meta-label {
        color: var(--pd-muted);
        min-width: 60px;
    }

    .pd-meta-value {
        font-weight: 500;
        color: var(--pd-ink);
    }

    .pd-stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .pd-stock-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--pd-green);
    }

    .stock-green {
        color: var(--pd-green);
    }

    .stock-red {
        color: var(--pd-red);
    }

    .stock-red .pd-stock-dot {
        background: var(--pd-red);
    }

    .pd-seller {
        font-size: 0.82rem;
        color: var(--pd-muted);
    }

    .pd-seller strong {
        color: var(--pd-ink);
    }

    .pd-divider {
        border: none;
        border-top: 1px solid var(--pd-border);
    }

    .pd-btn-cart {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        height: 52px;
        border-radius: var(--pd-radius);
        background: #1a1a1a;
        color: white;
        font-size: 0.95rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        letter-spacing: 0.02em;
    }

    .pd-btn-cart:hover {
        background: #333;
        transform: translateY(-1px);
    }

    .pd-benefits {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .pd-benefit-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        color: var(--pd-muted);
        padding: 8px 12px;
        border-radius: 8px;
        background: var(--pd-bg);
        border: 1px solid var(--pd-border);
    }

    /* ── TABS SECTION ── */
    .pd-tabs-section {
        border-top: 1px solid var(--pd-border);
        padding-top: 2rem;
        margin-bottom: 3rem;
    }

    .pd-tab-nav {
        display: flex;
        gap: 0;
        border-bottom: 1px solid var(--pd-border);
        margin-bottom: 1.5rem;
    }

    .pd-tab-btn {
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--pd-muted);
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 0.75rem 1.5rem;
        cursor: pointer;
        transition: color 0.2s, border-color 0.2s;
        margin-bottom: -1px;
    }

    .pd-tab-btn.active {
        color: var(--pd-ink);
        border-bottom-color: var(--pd-ink);
    }

    .pd-tab-btn:hover {
        color: var(--pd-ink);
    }

    .pd-tab-panel {
        display: none;
    }

    .pd-tab-panel.active {
        display: block;
    }

    /* Description Tab */
    .pd-description {
        font-size: 0.95rem;
        line-height: 1.75;
        color: #444;
        max-width: 700px;
    }

    .pd-description p {
        margin-bottom: 1rem;
    }

    .pd-specs-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
        margin-top: 1rem;
    }

    .pd-specs-table tr {
        border-bottom: 1px solid var(--pd-border);
    }

    .pd-specs-table td {
        padding: 10px 0;
        color: var(--pd-muted);
    }

    .pd-specs-table td:last-child {
        color: var(--pd-ink);
        font-weight: 600;
        text-align: right;
    }

    /* ── REVIEW TAB ── */
    .pd-review-summary {
        display: flex;
        align-items: center;
        gap: 3rem;
        padding: 1.5rem;
        background: var(--pd-bg);
        border-radius: var(--pd-radius);
        border: 1px solid var(--pd-border);
        margin-bottom: 2rem;
    }

    .pd-big-rating {
        text-align: center;
        flex-shrink: 0;
    }

    .pd-big-rating .num {
        font-size: 3.5rem;
        font-weight: 900;
        line-height: 1;
        color: var(--pd-ink);
    }

    .pd-big-rating .stars-row {
        display: flex;
        justify-content: center;
        gap: 2px;
        margin: 4px 0;
    }

    .pd-big-rating .stars-row span {
        color: var(--pd-gold);
        font-size: 1.1rem;
    }

    .pd-big-rating .lbl {
        font-size: 0.8rem;
        color: var(--pd-muted);
    }

    .pd-rating-bars {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .pd-rating-bar-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
    }

    .pd-rating-bar-row .lbl {
        color: var(--pd-muted);
        width: 50px;
        text-align: right;
    }

    .pd-bar-track {
        flex: 1;
        height: 8px;
        background: var(--pd-border);
        border-radius: 999px;
        overflow: hidden;
    }

    .pd-bar-fill {
        height: 100%;
        background: var(--pd-gold);
        border-radius: 999px;
        transition: width 0.4s;
    }

    .pd-rating-bar-row .cnt {
        width: 20px;
        color: var(--pd-muted);
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* Review Form */
    .pd-review-form-card {
        background: white;
        border: 1px solid var(--pd-border);
        border-radius: var(--pd-radius);
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--pd-shadow);
    }

    .pd-review-form-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--pd-ink);
        margin: 0 0 1rem;
    }

    .star-picker {
        display: flex;
        gap: 6px;
        margin-bottom: 1rem;
    }

    .star-picker input[type="radio"] {
        display: none;
    }

    .star-picker label {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.15s;
        line-height: 1;
    }

    .star-picker label:hover,
    .star-picker label:hover~label,
    .star-picker input:checked~label {
        color: #ddd;
    }

    .star-picker input:checked+label,
    .star-picker label:hover {
        color: var(--pd-gold);
    }

    /* JS-controlled star picker */
    .star-picker .s-label.active {
        color: var(--pd-gold);
    }

    .pd-review-form-card textarea {
        width: 100%;
        min-height: 90px;
        padding: 0.65rem 0.9rem;
        border: 1px solid var(--pd-border);
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.875rem;
        resize: vertical;
        outline: none;
        transition: border-color 0.2s;
        margin-bottom: 0.75rem;
    }

    .pd-review-form-card textarea:focus {
        border-color: var(--pd-blue);
    }

    .pd-btn-submit-review {
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        background: var(--pd-blue);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .pd-btn-submit-review:hover {
        background: #145088;
    }

    .pd-login-prompt {
        background: #f0f7ff;
        border: 1px solid #bee3f8;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        font-size: 0.875rem;
        color: #2c5282;
        margin-bottom: 2rem;
    }

    .pd-login-prompt a {
        color: var(--pd-blue);
        font-weight: 600;
        text-decoration: none;
    }

    /* Review Cards */
    .pd-reviews-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .pd-review-card {
        background: white;
        border: 1px solid var(--pd-border);
        border-radius: var(--pd-radius);
        padding: 1.25rem;
    }

    .pd-review-card-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 0.75rem;
    }

    .pd-reviewer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--pd-blue), #0D3B5E);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.9rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .pd-reviewer-info strong {
        display: block;
        font-size: 0.9rem;
        color: var(--pd-ink);
    }

    .pd-reviewer-date {
        font-size: 0.78rem;
        color: var(--pd-muted);
    }

    .pd-review-stars {
        margin-left: auto;
        display: flex;
        gap: 2px;
    }

    .pd-review-stars span {
        color: var(--pd-gold);
        font-size: 0.9rem;
    }

    .pd-review-comment {
        font-size: 0.875rem;
        color: #444;
        line-height: 1.65;
    }

    .pd-own-badge {
        font-size: 0.72rem;
        color: var(--pd-blue);
        background: #e8f4fd;
        border: 1px solid #bee3f8;
        padding: 2px 8px;
        border-radius: 999px;
        margin-left: 8px;
    }

    .pd-delete-review {
        font-family: inherit;
        font-size: 0.78rem;
        color: var(--pd-red);
        background: none;
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 3px 10px;
        border-radius: 6px;
        cursor: pointer;
        margin-left: auto;
        transition: background 0.2s;
    }

    .pd-delete-review:hover {
        background: rgba(239, 68, 68, 0.06);
    }

    .pd-no-reviews {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--pd-muted);
        font-size: 0.9rem;
    }

    /* Flash */
    .pd-flash {
        padding: 0.875rem 1.25rem;
        border-radius: 10px;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    .pd-flash-success {
        background: rgba(16, 185, 129, 0.08);
        border: 1px solid rgba(16, 185, 129, 0.25);
        color: #065F46;
    }

    @media (max-width: 768px) {
        .pd-top {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .pd-name {
            font-size: 1.4rem;
        }

        .pd-price {
            font-size: 1.5rem;
        }

        .pd-review-summary {
            flex-direction: column;
            gap: 1.5rem;
        }

        .pd-benefits {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="pd-page">

    {{-- Breadcrumb --}}
    <nav class="pd-breadcrumb" aria-label="Breadcrumb">
        <a href="/">Beranda</a>
        <span>›</span>
        <a href="/toko">Toko</a>
        <span>›</span>
        <span>{{ Str::limit($product->name, 40) }}</span>
    </nav>

    {{-- Flash --}}
    @if(session('success'))
    <div class="pd-flash pd-flash-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="pd-flash" style="background:rgba(239,68,68,0.06); border:1px solid rgba(239,68,68,0.2); color:#991B1B;">
        ⚠ {{ session('error') }}
    </div>
    @endif

    {{-- TOP: Image + Info --}}
    <div class="pd-top">

        {{-- Gambar --}}
        <div class="pd-image-panel">
            <div class="pd-main-image">
                <img src="{{ $image }}" alt="{{ $product->name }}">
            </div>
        </div>

        {{-- Info --}}
        <div class="pd-info-panel">
            {{-- Tags --}}
            <div class="pd-category-tags">
                <span class="pd-tag">{{ $product->category ?? 'Outdoor' }}</span>
            </div>

            {{-- Nama --}}
            <h1 class="pd-name">{{ strtoupper($product->name) }}</h1>

            {{-- Rating --}}
            <div class="pd-rating-row">
                <div class="pd-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= floor($avgRating) ? 'filled' : ($i - 0.5 <= $avgRating ? 'half' : '') }}">★</span>
                        @endfor
                </div>
                <span class="pd-avg-num">{{ number_format($avgRating, 1) }}</span>
                <span class="pd-review-count">({{ $reviewCount }} ulasan)</span>
            </div>

            {{-- Harga --}}
            <p class="pd-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            {{-- Meta --}}
            <div class="pd-meta-row">
                <div class="pd-meta-item">
                    <span class="pd-meta-label">Stok</span>
                    <span class="pd-meta-value pd-stock-badge {{ $product->stock > 0 ? 'stock-green' : 'stock-red' }}">
                        <span class="pd-stock-dot"></span>
                        {{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Habis' }}
                    </span>
                </div>
                @if($product->seller)
                <div class="pd-meta-item">
                    <span class="pd-meta-label">Penjual</span>
                    <span class="pd-meta-value">{{ $product->seller->name }}</span>
                </div>
                @endif
            </div>

            <hr class="pd-divider">

            {{-- Tambah Keranjang --}}
            <button type="button" class="pd-btn-cart"
                data-id="{{ $product->id }}"
                data-name="{{ addslashes($product->name) }}"
                data-price="{{ (int) $product->price }}"
                onclick="addToCartDirect(this)">
                🛒 Tambah ke Keranjang
            </button>

            {{-- Benefits --}}
            <div class="pd-benefits">
                <div class="pd-benefit-item">🚚 Gratis ongkir min. Rp 500.000</div>
                <div class="pd-benefit-item">🛡️ Garansi resmi produk</div>
                <div class="pd-benefit-item">↩️ Retur 14 hari</div>
                <div class="pd-benefit-item">💬 Layanan 24/7</div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="pd-tabs-section">
        <div class="pd-tab-nav">
            <button class="pd-tab-btn active" onclick="switchTab(event, 'tab-desc')">Tentang Produk</button>
            <button class="pd-tab-btn" onclick="switchTab(event, 'tab-reviews')">
                Ulasan Pembeli ({{ $reviewCount }})
            </button>
        </div>

        {{-- Deskripsi --}}
        <div id="tab-desc" class="pd-tab-panel active">
            <div class="pd-description">
                @if($product->description)
                {!! nl2br(e($product->description)) !!}
                @else
                <p style="color:#999;">Deskripsi produk belum ditambahkan.</p>
                @endif
            </div>

            <table class="pd-specs-table">
                <tr>
                    <td>Kategori</td>
                    <td>{{ $product->category ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td>{{ $product->stock }}</td>
                </tr>
                @if($product->seller)
                <tr>
                    <td>Penjual</td>
                    <td>{{ $product->seller->name }}</td>
                </tr>
                @endif
            </table>
        </div>

        {{-- Ulasan --}}
        <div id="tab-reviews" class="pd-tab-panel">

            {{-- Ringkasan Rating --}}
            <div class="pd-review-summary">
                <div class="pd-big-rating">
                    <div class="num">{{ number_format($avgRating, 1) }}</div>
                    <div class="stars-row">
                        @for($i = 1; $i <= 5; $i++)
                            <span>{{ $i <= round($avgRating) ? '★' : '☆' }}</span>
                            @endfor
                    </div>
                    <div class="lbl">{{ $reviewCount }} Reviews</div>
                </div>
                <div class="pd-rating-bars">
                    @foreach($ratingDistribution as $star => $count)
                    <div class="pd-rating-bar-row">
                        <span class="lbl">{{ $star }} rating</span>
                        <div class="pd-bar-track">
                            <div class="pd-bar-fill" style="width: {{ $reviewCount > 0 ? ($count / $reviewCount * 100) : 0 }}%"></div>
                        </div>
                        <span class="cnt">{{ $count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Form Review: hanya untuk pembeli terverifikasi --}}
            @auth
            @if($userReview)
            {{-- User sudah review → tampilkan ulasan mereka dengan opsi edit/hapus --}}
            <div class="pd-review-form-card">
                <h4>✏️ Ulasan Anda</h4>
                <p style="font-size:0.875rem; color:#444; margin-bottom:0.75rem;">
                    Anda sudah memberikan rating <strong>{{ $userReview->rating }}/5</strong> untuk produk ini.
                    @if($userReview->comment) <br>Komentar: "{{ $userReview->comment }}"@endif
                </p>
                <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                    <button onclick="document.getElementById('editReviewForm').classList.toggle('hidden')" style="font-family:inherit;font-size:0.82rem;color:var(--pd-blue);background:none;border:1px solid rgba(26,111,168,0.3);padding:4px 12px;border-radius:6px;cursor:pointer;">
                        Edit Ulasan
                    </button>
                    <form action="{{ route('products.review.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus ulasan Anda?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="pd-delete-review" style="margin-left:0;">Hapus Ulasan</button>
                    </form>
                </div>
                <form id="editReviewForm" class="hidden" action="{{ route('products.review.store', $product) }}" method="POST" style="margin-top:1rem;">
                    @csrf
                    <div class="star-picker" id="editStarPicker">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="s-label {{ $i <= $userReview->rating ? 'active' : '' }}" data-val="{{ $i }}" style="font-size:2rem; cursor:pointer; color:{{ $i <= $userReview->rating ? '#e58b35' : '#ddd' }};">★</span>
                            @endfor
                            <input type="hidden" name="rating" id="editRatingInput" value="{{ $userReview->rating }}">
                    </div>
                    <textarea name="comment" placeholder="Ceritakan pengalaman Anda...">{{ $userReview->comment }}</textarea>
                    <button type="submit" class="pd-btn-submit-review">Perbarui Ulasan</button>
                </form>
            </div>

            @elseif($hasPurchased)
            {{-- Sudah beli, belum review → tampilkan form --}}
            <div class="pd-review-form-card">
                <h4>⭐ Berikan Ulasan Anda</h4>
                <p style="font-size:0.82rem; color:#10b981; margin-bottom:0.75rem;">
                    ✓ Anda telah membeli produk ini. Bagikan pengalaman Anda!
                </p>
                <form action="{{ route('products.review.store', $product) }}" method="POST">
                    @csrf
                    <div class="star-picker" id="starPicker">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="s-label" data-val="{{ $i }}" style="font-size:2rem; cursor:pointer; color:#ddd;">★</span>
                            @endfor
                            <input type="hidden" name="rating" id="ratingInput" value="">
                    </div>
                    @error('rating')<p style="font-size:0.82rem; color:#ef4444; margin-bottom:0.75rem;">{{ $message }}</p>@enderror
                    <textarea name="comment" placeholder="Ceritakan pengalaman Anda dengan produk ini... (opsional)"></textarea>
                    <button type="submit" class="pd-btn-submit-review">Kirim Ulasan</button>
                </form>
            </div>

            @else
            {{-- Sudah login tapi belum beli --}}
            <div class="pd-login-prompt" style="background:#fff9ec; border-color:#fcd34d; color:#78350f;">
                🛒 Hanya pembeli yang telah menyelesaikan pembayaran yang dapat memberikan ulasan.
                <a href="/toko" style="color:#d97706; font-weight:600; text-decoration:none; margin-left:4px;">Beli produk ini →</a>
            </div>
            @endif
            @else
            {{-- Belum login --}}
            <div class="pd-login-prompt">
                💡 <a href="{{ route('login') }}">Masuk</a> atau <a href="{{ route('register') }}">daftar</a>, lalu selesaikan pembelian untuk dapat memberikan ulasan.
            </div>
            @endauth

            {{-- Daftar Ulasan --}}
            @if($reviews->count() > 0)
            <div class="pd-reviews-list">
                @foreach($reviews as $review)
                <div class="pd-review-card">
                    <div class="pd-review-card-top">
                        <div class="pd-reviewer-avatar">{{ strtoupper(substr($review->user->name, 0, 2)) }}</div>
                        <div class="pd-reviewer-info">
                            <strong>
                                {{ substr($review->user->name, 0, 1) }}***** {{ substr($review->user->name, -1) }}*****
                                @if(auth()->check() && $review->user_id === auth()->id())
                                <span class="pd-own-badge">Ulasan Anda</span>
                                @endif
                            </strong>
                            <span class="pd-reviewer-date">{{ $review->created_at->isoFormat('D MMM YYYY') }}</span>
                        </div>
                        <div class="pd-review-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                @endfor
                        </div>
                    </div>
                    @if($review->comment)
                    <p class="pd-review-comment">{{ $review->comment }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="pd-no-reviews">
                <p>Belum ada ulasan untuk produk ini.</p>
                <p>Jadilah yang pertama memberikan ulasan!</p>
            </div>
            @endif
        </div>
    </div>

</div>

<script>
    function switchTab(e, tabId) {
        document.querySelectorAll('.pd-tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.pd-tab-panel').forEach(p => p.classList.remove('active'));
        e.currentTarget.classList.add('active');
        document.getElementById(tabId).classList.add('active');
    }

    // Star picker interactive
    function initStarPicker(wrapperId, inputId) {
        const wrapper = document.getElementById(wrapperId);
        if (!wrapper) return;
        const stars = wrapper.querySelectorAll('.s-label');
        const input = document.getElementById(inputId);

        stars.forEach((star, idx) => {
            star.addEventListener('mouseover', () => {
                stars.forEach((s, i) => s.style.color = i <= idx ? '#e58b35' : '#ddd');
            });
            star.addEventListener('mouseout', () => {
                const val = parseInt(input.value) || 0;
                stars.forEach((s, i) => s.style.color = i < val ? '#e58b35' : '#ddd');
            });
            star.addEventListener('click', () => {
                input.value = star.dataset.val;
                stars.forEach((s, i) => s.style.color = i < star.dataset.val ? '#e58b35' : '#ddd');
            });
        });
    }

    initStarPicker('starPicker', 'ratingInput');
    initStarPicker('editStarPicker', 'editRatingInput');

    // Add to cart (reuse outdoorstore.js function if available)
    function addToCartDirect(btn) {
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const price = btn.dataset.price;
        if (typeof addToCart === 'function') {
            addToCart(btn, id, name, price);
        } else {
            alert('Produk ditambahkan ke keranjang!');
        }
    }

    // Toggle hidden
    document.querySelectorAll('.hidden').forEach(el => el.style.display = 'none');
    document.querySelectorAll('[onclick*="editReviewForm"]').forEach(btn => {
        btn.onclick = function() {
            const f = document.getElementById('editReviewForm');
            f.style.display = f.style.display === 'none' ? 'block' : 'none';
        };
    });
</script>
@endsection