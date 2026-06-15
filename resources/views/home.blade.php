@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-2xl p-16 text-center mb-12">
        <h1 class="text-5xl font-bold mb-4">Jelajahi Dunia Bersama Kami</h1>
        <p class="text-xl text-blue-100 mb-8">Temukan destinasi terbaik, produk travel, dan inspirasi perjalanan</p>
        <div class="flex flex-col items-center gap-3 sm:flex-row sm:justify-center">
            <a href="/destinasi" class="rounded-full bg-white px-8 py-3 text-sm font-bold text-blue-700 transition hover:bg-blue-50">
                Mulai Jelajahi →
            </a>
            <a href="/toko" class="rounded-full bg-slate-950 px-8 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                Kunjungi Toko Outdoor →
            </a>
        </div>
    </div>

    {{-- Section Berita Terkini --}}
    <div class="mt-12 mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Berita Terkini</h2>
        <p class="text-gray-500 mb-6">Informasi dan update terbaru seputar destinasi dan perjalanan</p>

        <div class="grid grid-cols-3 gap-6">
            @forelse($beritaTerbaru as $item)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                    
                    {{-- Menampilkan Thumbnail Berita atau Fallback Emoji --}}
                    @if($item->thumbnail)
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="bg-yellow-100 h-48 flex items-center justify-center text-5xl">📰</div>
                    @endif

                    <div class="p-4">
                        <p class="text-xs text-gray-400 mb-1">{{ $item->created_at->format('d M Y') }}</p>
                        <h3 class="font-bold text-lg text-gray-800 line-clamp-1">{{ $item->title }}</h3>
                        <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ strip_tags($item->content) }}</p>
                        <a href="/berita/{{ $item->id }}"
                           class="mt-3 inline-block text-blue-600 hover:underline text-sm font-medium">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 col-span-3">Belum ada berita terbaru saat ini.</p>
            @endforelse
        </div>
    </div>


    {{-- Section Destinasi Unggulan --}}
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Destinasi Unggulan</h2>
        <p class="text-gray-500 mb-6">Tempat-tempat terbaik yang wajib Anda kunjungi</p>

        <div class="grid grid-cols-3 gap-6">
            @forelse($destinations as $destination)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                    
                    {{-- Menampilkan Foto atau Fallback Emoji --}}
                    @if($destination->image)
                        <img src="{{ asset('storage/' . $destination->image) }}" 
                             alt="Foto {{ $destination->name }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="bg-blue-100 h-48 flex items-center justify-center text-5xl">🏝️</div>
                    @endif

                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800">{{ $destination->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">📍 {{ $destination->location }}</p>
                        <a href="/destinasi/{{ $destination->id }}"
                           class="mt-3 inline-block text-blue-600 hover:underline text-sm font-medium">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 col-span-3">Belum ada destinasi tersedia.</p>
            @endforelse
        </div>
    </div>

    {{-- Section Pilihan Populer (sama seperti di toko) --}}
    <div class="home-popular-section">
        <div class="home-popular-header">
            <div>
                <h2>Pilihan Populer</h2>
                <p class="home-popular-subtitle">Perlengkapan perjalanan terbaik untuk Anda</p>
            </div>
            <a href="/toko" class="home-see-all">Lihat Semua →</a>
        </div>

        <div class="home-popular-carousel-wrap">
            <button class="home-carousel-arrow home-arrow-left" id="homePopularPrev" type="button" aria-label="Sebelumnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <div class="home-popular-carousel" id="homePopularCarousel">
                @forelse($products as $product)
                @php
                    $productImage = $product->image;
                    if ($productImage && !\Illuminate\Support\Str::startsWith($productImage, ['http://', 'https://'])) {
                        if (file_exists(public_path('images/' . $productImage))) {
                            $productImage = asset('images/' . $productImage);
                        } else {
                            $productImage = asset('storage/' . $productImage);
                        }
                    } elseif (!$productImage) {
                        $productImage = asset('images/logo_web.jpeg');
                    }
                    $rating = number_format($product->rating ?? 0, 1);
                @endphp
                <div class="home-popular-card">
                    <div class="home-popular-card-image">
                        <img src="{{ $productImage }}" alt="{{ $product->name }}" loading="lazy">
                    </div>
                    <div class="home-popular-card-info">
                        <strong>{{ \Illuminate\Support\Str::limit($product->name, 24) }}</strong>
                        <span class="home-popular-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <div class="home-popular-rating">
                            <span class="home-rating-star">★</span>
                            <span>{{ $rating }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <p style="color:#999; font-size:0.9rem;">Belum ada produk tersedia.</p>
                @endforelse
            </div>

            <button class="home-carousel-arrow home-arrow-right" id="homePopularNext" type="button" aria-label="Selanjutnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>

    {{-- CSS & JS khusus Pilihan Populer di Beranda --}}
    <style>
        .home-popular-section {
            margin-top: 3rem;
            padding: 2.5rem 0 0;
            border-top: 1px solid #e5e5e5;
        }
        .home-popular-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        .home-popular-header h2 {
            font-size: 1.6rem;
            font-weight: 800;
            margin: 0;
            color: #1a1a1a;
        }
        .home-popular-subtitle {
            color: #777;
            font-size: 0.9rem;
            margin: 0.25rem 0 0;
        }
        .home-see-all {
            font-size: 0.875rem;
            font-weight: 600;
            color: #777;
            text-decoration: none;
            transition: color 0.25s;
            white-space: nowrap;
            margin-top: 0.25rem;
        }
        .home-see-all:hover { color: #145088; }

        .home-popular-carousel-wrap {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .home-carousel-arrow {
            flex-shrink: 0;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1.5px solid #e5e5e5;
            background: #fff;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.25s;
            z-index: 3;
        }
        .home-carousel-arrow:hover {
            border-color: #c4c4c4;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            color: #1a1a1a;
        }
        .home-popular-carousel {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
            flex: 1;
            padding: 4px 0;
        }
        .home-popular-carousel::-webkit-scrollbar { display: none; }

        .home-popular-card {
            flex: 0 0 200px;
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: 0.25s;
            cursor: pointer;
        }
        .home-popular-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            border-color: #c4c4c4;
        }
        .home-popular-card-image {
            width: 100%;
            aspect-ratio: 1/1;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f3f3;
        }
        .home-popular-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }
        .home-popular-card:hover .home-popular-card-image img {
            transform: scale(1.05);
        }
        .home-popular-card-info strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.3;
            color: #1a1a1a;
            margin-bottom: 4px;
        }
        .home-popular-price {
            display: block;
            font-size: 13px;
            font-weight: 800;
            color: #444;
            margin-bottom: 4px;
        }
        .home-popular-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #777;
            font-weight: 600;
        }
        .home-rating-star { color: #e58b35; font-size: 12px; }

        @media (max-width: 600px) {
            .home-popular-card { flex: 0 0 160px; }
            .home-carousel-arrow { display: none; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('homePopularCarousel');
            const prevBtn = document.getElementById('homePopularPrev');
            const nextBtn = document.getElementById('homePopularNext');
            if (carousel && prevBtn && nextBtn) {
                const scrollAmount = 220;
                prevBtn.addEventListener('click', () => carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' }));
                nextBtn.addEventListener('click', () => carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' }));
            }
        });
    </script>

@endsection