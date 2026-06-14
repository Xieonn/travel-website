@extends('layouts.app')

@section('title', 'Toko Outdoor - Perlengkapan Pendakian')

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/outdoorstore.css') }}">
@endpush

@section('content')
<div class="store-page">

    {{-- ======================== HERO SECTION ======================== --}}
    <section class="store-hero">
        <div class="hero-overlay"></div>

        <div class="hero-copy">
            <span class="hero-kicker">GEAR UP, EXPLORE MORE</span>
            <h1>Perlengkapan Outdoor untuk Pendakian yang Siap Dipakai</h1>
            <p>
                Koleksi perlengkapan hiking dan pakaian outdoor terbaik untuk
                setiap perjalananmu. Tahan banting, nyaman digunakan, dan
                siap menemani petualangan tanpa batas.
            </p>

            <div class="hero-actions">
                <a href="#produk" class="btn-primary-store">Belanja Sekarang</a>
                <a href="#kategori" class="btn-ghost-store">Lihat Katalog</a>
            </div>

            <div class="hero-trust-badges">
                <span>✓ Produk Original</span>
                <span>✓ Garansi Resmi</span>
                <span>✓ Pengiriman Cepat</span>
                <span>✓ Pembayaran Aman</span>
            </div>
        </div>

        <div class="hero-visual">
            <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=1200&q=80" alt="Pendaki gunung dengan perlengkapan outdoor">

            {{-- Floating product cards --}}
            <div class="hero-product-card card-hiking-shoes">
                <div class="hpc-image">
                    <img src="{{ asset('images/vectiv.webp') }}" alt="Hiking Shoes">
                </div>
                <div class="hpc-info">
                    <strong>Hiking Shoes</strong>
                    <span>Grip Maksimal</span>
                </div>
            </div>

            <div class="hero-product-card card-carrier">
                <div class="hpc-image">
                    <img src="{{ asset('images/terra45.webp') }}" alt="Carrier 60L">
                </div>
                <div class="hpc-info">
                    <strong>Carrier 60L</strong>
                    <span>Tahan Air & Nyaman</span>
                </div>
            </div>

            <div class="hero-product-card card-jacket">
                <div class="hpc-image">
                    <img src="{{ asset('images/jaket.webp') }}" alt="Jaket Outdoor">
                </div>
                <div class="hpc-info">
                    <strong>Jaket Outdoor</strong>
                    <span>Waterproof</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ======================== SEARCH & FILTER BAR ======================== --}}
    <section id="kategori" class="search-filter-bar">
        <div class="search-box-wrapper">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="searchInput" placeholder="Cari produk, kategori, atau brand..." oninput="filterProducts()">
        </div>

        <div class="sort-wrapper">
            <span class="sort-label">Urutkan:</span>
            <select id="sortInput" onchange="filterProducts()">
                <option value="default">Terbaru</option>
                <option value="low">Harga Terendah</option>
                <option value="high">Harga Tertinggi</option>
                <option value="az">Nama A-Z</option>
            </select>
        </div>
    </section>

    {{-- ======================== CATEGORY TABS ======================== --}}
    <section class="category-tabs">
        <button class="cat-tab active" onclick="setCategory(this, 'all')">Semua</button>
        <button class="cat-tab" onclick="setCategory(this, 'Alat hiking')">Alat Hiking</button>
        <button class="cat-tab" onclick="setCategory(this, 'pakaian')">Pakaian</button>
        <button class="cat-tab" onclick="setCategory(this, 'Carrier')">Carrier</button>
        <button class="cat-tab" onclick="setCategory(this, 'Tenda')">Tenda</button>
        <button class="cat-tab" onclick="setCategory(this, 'Sepatu')">Sepatu</button>
        <button class="cat-tab" onclick="setCategory(this, 'Jaket')">Jaket</button>
        <button class="cat-tab" onclick="setCategory(this, 'Aksesoris')">Aksesoris</button>
        <button class="cat-tab" onclick="setCategory(this, 'Sleeping Gear')">Sleeping Gear</button>
    </section>

    {{-- ======================== PRODUCT GRID ======================== --}}
    <section id="produk" class="product-section">
        <p id="productCounter" class="product-counter"></p>

        <div id="productGrid" class="product-grid">
            @forelse($products as $product)
            @php
            // --- GABUNGAN KODE GAMBAR ---
            $image = $product->image;
            if (!$image) {
                // Gunakan gambar dummy temanmu jika di database kosong
                $daftarGambar = ['terra45.webp', 'vectiv.webp', 'tenda.webp', 'jaket.webp'];
                $namaGambar = $daftarGambar[$loop->index % count($daftarGambar)];
                $image = asset('images/' . $namaGambar);
            } elseif (!\Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])) {
                // Path storage dari kodemu
                $image = asset('storage/' . $image);
            }

            $categoryLabel = $product->category ?? 'Outdoor';
            $nameLower = strtolower($product->name);
            if (str_contains($nameLower, 'jaket') || str_contains($nameLower, 'jacket')) {
                $subCategory = 'Jaket · Outdoor';
            } elseif (str_contains($nameLower, 'sepatu') || str_contains($nameLower, 'shoe') || str_contains($nameLower, 'boot')) {
                $subCategory = 'Sepatu · Hiking';
            } elseif (str_contains($nameLower, 'tenda') || str_contains($nameLower, 'tent')) {
                $subCategory = 'Tenda · Camping';
            } elseif (str_contains($nameLower, 'carrier') || str_contains($nameLower, 'backpack') || str_contains($nameLower, 'tas')) {
                $subCategory = 'Tas · Carrier';
            } elseif (str_contains($nameLower, 'sleeping') || str_contains($nameLower, 'matras')) {
                $subCategory = 'Sleeping Gear';
            } elseif (str_contains($nameLower, 'botol') || str_contains($nameLower, 'bottle') || str_contains($nameLower, 'water')) {
                $subCategory = 'Botol · Hydration';
            } elseif (str_contains($nameLower, 'headlamp') || str_contains($nameLower, 'senter') || str_contains($nameLower, 'lamp')) {
                $subCategory = 'Aksesoris · Lighting';
            } elseif (strtolower($product->category) === 'pakaian') {
                $subCategory = 'Pakaian · Outdoor';
            } else {
                $subCategory = ucfirst($product->category ?? 'Outdoor');
            }

            // --- GABUNGAN RATING & SOLD COUNT ---
            // Cek nilai DB kodemu dulu, jika 0 pakai random temanmu
            $dbRating = $product->rating ?? 0;
            if ($dbRating > 0) {
                $rating = number_format($dbRating, 1);
            } else {
                $ratings = ['4.5', '4.6', '4.7', '4.8', '4.9'];
                $rating = $ratings[$loop->index % count($ratings)];
            }

            $dbSold = $product->sold_count ?? 0;
            if ($dbSold > 0) {
                $soldCount = $dbSold;
            } else {
                $sold = [42, 56, 73, 88, 96, 103, 120, 128];
                $soldCount = $sold[$loop->index % count($sold)];
            }
            @endphp

            <article class="product-card"
                data-category="{{ $product->category }}"
                data-name="{{ strtolower($product->name) }}"
                data-search="{{ strtolower($product->name . ' ' . $product->description . ' ' . $product->category) }}"
                data-price="{{ (int) $product->price }}">

                <div class="product-image">
                    <img src="{{ $image }}" alt="{{ $product->name }}" loading="lazy">
                    <button class="wishlist-btn" type="button" onclick="toggleWishlist(this)" aria-label="Tambah ke wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                    @if($loop->index === 0)
                    <span class="product-badge badge-bestseller">BEST SELLER</span>
                    @endif
                </div>

                <div class="product-content">
                    <h3>{{ $product->name }}</h3>
                    <p class="product-subcategory">{{ $subCategory }}</p>

                    <div class="product-pricing">
                        <strong class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                        <div class="product-rating">
                            <span class="rating-star">★</span>
                            <span class="rating-value">{{ $rating }}</span>
                            <span class="rating-count">({{ $soldCount }})</span>
                        </div>
                    </div>

                    <div class="product-stock">
                        <span class="stock-dot"></span> Stok: Tersedia
                    </div>

                    <button type="button"
                        class="btn-add-cart"
                        data-id="{{ $product->id }}"
                        data-name="{{ addslashes($product->name) }}"
                        data-price="{{ (int) $product->price }}"
                        onclick="addToCart(this, this.dataset.id, this.dataset.name, this.dataset.price)">
                        + Tambah ke Keranjang
                    </button>
                </div>
            </article>
            @empty
            <div class="empty-product">
                <h3>Belum ada produk</h3>
                <p>Produk akan tampil setelah seller mengunggah data produk.</p>
            </div>
            @endforelse
        </div>

        <div class="load-more-wrap">
            <button type="button" class="load-more-btn" id="loadMoreBtn">
                Muat Lebih Banyak Produk
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
        </div>
    </section>

    {{-- ======================== POPULAR PICKS ======================== --}}
    <section class="popular-section">
        <div class="popular-header">
            <h2>Pilihan Populer</h2>
            <a href="#produk" class="see-all-link">Lihat Semua →</a>
        </div>

        <div class="popular-carousel-wrapper">
            <button class="carousel-arrow arrow-left" id="popularPrev" type="button" aria-label="Sebelumnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <div class="popular-carousel" id="popularCarousel">
                @foreach($products->take(8) as $product)
                @php
                // --- GABUNGAN GAMBAR & RATING POPULAR PICKS ---
                $popularImage = $product->image;
                if (!$popularImage) {
                    $daftarGambarPopuler = ['terra45.webp', 'vectiv.webp', 'tenda.webp', 'jaket.webp'];
                    $namaGambarPopuler = $daftarGambarPopuler[$loop->index % count($daftarGambarPopuler)];
                    $popularImage = asset('images/' . $namaGambarPopuler);
                } elseif (!\Illuminate\Support\Str::startsWith($popularImage, ['http://', 'https://'])) {
                    $popularImage = asset('storage/' . $popularImage);
                }
                
                $dbRatingPop = $product->rating ?? 0;
                if ($dbRatingPop > 0) {
                    $rating = number_format($dbRatingPop, 1);
                } else {
                    $ratings = ['4.5', '4.6', '4.7', '4.8', '4.9'];
                    $rating = $ratings[$loop->index % count($ratings)];
                }
                @endphp

                <div class="popular-card">
                    <div class="popular-card-image">
                        <img src="{{ $popularImage }}" alt="{{ $product->name }}" loading="lazy">
                    </div>
                    <div class="popular-card-info">
                        <strong>{{ \Illuminate\Support\Str::limit($product->name, 24) }}</strong>
                        <span class="popular-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <div class="popular-rating">
                            <span class="rating-star">★</span>
                            <span>{{ $rating }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button class="carousel-arrow arrow-right" id="popularNext" type="button" aria-label="Selanjutnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </section>

    {{-- ======================== BENEFITS BAR ======================== --}}
    <section class="benefit-section">
        <div class="benefit-card">
            <div class="benefit-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="1" y="3" width="15" height="13"></rect>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg>
            </div>
            <div>
                <strong>Gratis Ongkir</strong>
                <p>Min. belanja Rp 500.000</p>
            </div>
        </div>

        <div class="benefit-card">
            <div class="benefit-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    <polyline points="9 12 11 14 15 10"></polyline>
                </svg>
            </div>
            <div>
                <strong>Garansi Resmi</strong>
                <p>Produk original & bergaransi</p>
            </div>
        </div>

        <div class="benefit-card">
            <div class="benefit-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <polyline points="1 4 1 10 7 10"></polyline>
                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                </svg>
            </div>
            <div>
                <strong>14 Hari Retur</strong>
                <p>Belanja aman & nyaman</p>
            </div>
        </div>

        <div class="benefit-card">
            <div class="benefit-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <div>
                <strong>Layanan 24/7</strong>
                <p>Chat kami kapan saja</p>
            </div>
        </div>
    </section>

    {{-- ======================== CART DRAWER ======================== --}}
    <div id="cartDrawer" class="cart-drawer">
        <div class="cart-backdrop" onclick="closeCart()"></div>
        <div class="cart-box">
            <div class="cart-head">
                <h3>🛒 Keranjang</h3>
                <button type="button" onclick="closeCart()">×</button>
            </div>
            <div id="cartItems" class="cart-items"></div>
            <div id="cartTotal" class="cart-total"></div>
        </div>
    </div>

    <button type="button" class="floating-cart" onclick="openCart()" aria-label="Buka keranjang">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
        <span id="cartCount">0</span>
    </button>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/outdoorstore.js') }}"></script>
@endpush