@extends('layouts.app')

@section('title', 'Outdoor Store')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/outdoorstore.css') }}">
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-grid">
            <div>
                <div class="badge">✨ OutdoorStore • Alat Hiking</div>
                <h1>Perlengkapan Hiking Premium untuk <span>Petualangan</span> Tak Terlupakan</h1>
                <p>Koleksi perlengkapan hiking dan pakaian outdoor terbaik dan berkualitas, serta dengan fungsi yang premium, dan kenyamanan maksimal untuk setiap jalur dan ketinggian.</p>
                <div class="btn-group">
                    <a href="#katalog" class="btn btn-primary">🔍 Lihat Katalog</a>
                    <a href="#kenapa" class="btn btn-secondary">Kenapa harus Kami? ↗</a>
                </div>
                <div class="stats">
                    <div class="stat">
                        <div class="stat-value">500+</div>
                        <div class="stat-label">Produk</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">4.9★</div>
                        <div class="stat-label">Rating</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">10K+</div>
                        <div class="stat-label">Puas</div>
                    </div>
                </div>
            </div>

            <div class="featured">
                <div class="featured-title">🔥 Barang Trending Minggu Ini</div>
                <div class="featured-item">
                    <div class="dot" style="background:#0ea5e9"></div>
                    <div>
                        <p>Sepatu Hiking The North Face Vectic Taraval</p>
                        <span>Menggunakan teknologi untuk meredam benturan dengan baik</span>
                    </div>
                </div>
                <div class="featured-item">
                    <div class="dot" style="background:#10b981"></div>
                    <div>
                        <p>The North Face Man Alta Vista Jacket</p>
                        <span>Menggunakan material 100% recycled DryVent yang sepenuhnya tahan air dan ramah lingkungan</span>
                    </div>
                </div>
                <div class="featured-item">
                    <div class="dot" style="background:#a78bfa"></div>
                    <div>
                        <p>Tenda The North Face Stormbreak</p>
                        <span>tenda ultralight dan tahan air untuk kegiatan camping, trekking, atau traveling</span>
                    </div>
                </div>
                <div class="promo">🚚 Gratis ongkir Rp 500K+ hari ini</div>
            </div>
        </div>
    </section>

    {{-- CATALOG --}}
    <section id="katalog" class="catalog">
        <div class="section-head">
            <div>
                <div class="eyebrow">Katalog Lengkap</div>
                <h2>Perlengkapan Outdoor Siap Pakai</h2>
            </div>
            <p class="section-desc">Pilih sesuai kebutuhan dari pendakian sehari hingga ekspedisi multi-hari.</p>
        </div>

        <div class="toolbar">
            <div class="search-box">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.35-4.35" />
                </svg>
                <input type="text" id="search" placeholder="Cari produk..." oninput="filter()">
                <button class="search-clear" type="button" onclick="clearSearch()">✕</button>
            </div>
            <div class="tabs">
                <button class="tab active" onclick="cat(this, 'all')">Semua <span class="tab-count" id="cnt-all">-</span></button>
                <button class="tab" onclick="cat(this, 'Alat hiking')">🥾 Alat <span class="tab-count" id="cnt-hiking">-</span></button>
                <button class="tab" onclick="cat(this, 'pakaian')">👕 Pakaian <span class="tab-count" id="cnt-pakaian">-</span></button>
            </div>
            <select id="sort" onchange="filter()">
                <option value="default">Default</option>
                <option value="price-low">Harga ↓</option>
                <option value="price-high">Harga ↑</option>
                <option value="name">Nama A–Z</option>
            </select>
        </div>

        <div id="counter" class="counter"></div>

        <div class="grid" id="grid">
            @forelse($products as $product)
            <div class="card" data-cat="{{ $product->category ?? 'hiking' }}" data-price="{{ $product->price }}" data-name="{{ strtolower($product->name) }}" data-search="{{ strtolower($product->name . ' ' . ($product->description ?? '')) }}">
                <div class="card-img">
                    @if(($product->category ?? 'hiking') === 'pakaian')
                    👕
                    <span class="card-badge emerald">Pakaian</span>
                    @else
                    ⛺
                    <span class="card-badge">Alat</span>
                    @endif
                    <button class="card-heart" onclick="toggleWish(this)">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                        </svg>
                    </button>
                </div>
                <div class="card-info">
                    <div class="card-header">
                        <span class="card-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="card-rating">
                            <svg class="star" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            {{ $product->rating ?? '4.8' }}
                        </span>
                    </div>
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <p class="card-desc">{{ $product->description ?? 'Perlengkapan outdoor premium' }}</p>
                    <div class="card-footer">
                        <span class="stock">Stok {{ $product->stock ?? 0 }}</span>
                        <button class="card-btn" data-name="{{ $product->name }}" data-price="{{ $product->price }}" onclick="addToCart(this, this.dataset.name, this.dataset.price)">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="9" cy="21" r="1" />
                                <circle cx="20" cy="21" r="1" />
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                            </svg>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M16 16s-1.5-2-4-2-4 2-4 2" />
                </svg>
                <p style="font-weight:600;margin-bottom:4px">Belum ada produk</p>
                <p style="font-size:12px">Cek kembali nanti</p>
            </div>
            @endforelse
        </div>

        <div id="cartModal" class="cart-modal" onclick="if(event.target === this) closeCart()">
            <div class="cart-panel">
                <div class="cart-header">
                    <h2>🛒 Keranjang Belanja</h2>
                    <button class="cart-close" onclick="closeCart()">✕</button>
                </div>
                <div class="cart-items" id="cartItems"></div>
                <div class="cart-footer" id="cartFooter"></div>
            </div>
        </div>

        <div class="cart-badge" onclick="openCart()">
            <span id="cartCountBadge">0</span>
            <div class="cart-count" id="cartCount" style="display: none;">0</div>
        </div>
    </section>

    {{-- WHY US --}}
    <section id="kenapa" class="why">
        <div class="why-grid">
            <div>
                <div class="eyebrow">Kenapa harus Kami?</div>
                <h2>Perlengkapan Hiking premium dengan Kualitas yang terjamin original</h2>
                <p>Semua produk dipilih khusus untuk kenyamanan, ketahanan, dan kepraktisan di jalur. Dari ransel dan tenda hingga jaket teknis, semuanya dirancang menemani perjalanan Anda dengan percaya diri.</p>
                <div class="why-cards">
                    <div class="why-card">
                        <div class="why-card-label">Performa Terpercaya</div>
                        <div class="why-card-text">Bahan kuat, fitur fungsional, detail yang mendukung mobilitas penuh di lapangan.</div>
                    </div>
                    <div class="why-card">
                        <div class="why-card-label">Desain Modern</div>
                        <div class="why-card-text">Estetika premium dengan tampilan segar untuk alam bebas maupun urban.</div>
                    </div>
                </div>
            </div>
            <div class="checklist">
                <div class="check">
                    <div class="check-num">1</div>
                    <div>
                        <p class="check-title">Ransel & Tas</p>
                        <p class="check-sub">Kapasitas cukup, kompartemen terorganisir, mudah dibawa.</p>
                    </div>
                </div>
                <div class="check">
                    <div class="check-num">2</div>
                    <div>
                        <p class="check-title">Tenda & Sleeping</p>
                        <p class="check-sub">Ringan, hangat, tahan cuaca ekstrim.</p>
                    </div>
                </div>
                <div class="check">
                    <div class="check-num">3</div>
                    <div>
                        <p class="check-title">Pakaian Teknis</p>
                        <p class="check-sub">Moisture wicking, windproof, nyaman sepanjang hari.</p>
                    </div>
                </div>
                <div class="check">
                    <div class="check-num">4</div>
                    <div>
                        <p class="check-title">Aksesori Safety</p>
                        <p class="check-sub">Headlamp, botol air, perlindungan elemen alam.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/outdoorstore.js') }}"></script>
@endpush