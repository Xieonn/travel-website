@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    {{-- HERO SECTION --}}
    <section class="relative w-full h-[550px] md:h-[650px] flex items-center bg-cover bg-center rounded-[32px] overflow-hidden shadow-2xl mb-16" 
             style="background-image: url('{{ asset('images/background_home.png') }}');">
        
        {{-- Overlay Gradient dengan hint dari brand-ink agar menyatu dengan tema gelap --}}
        <div class="absolute inset-0 bg-gradient-to-r from-[#0A1628]/80 via-[#0A1628]/40 to-transparent"></div> 

        <div class="relative z-10 w-full px-8 md:px-20 text-left">
            
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-white border border-white/20 px-4 py-2 rounded-full text-xs font-semibold mb-8 uppercase tracking-widest">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E8C87D" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m8 3 4 8 5-5 5 15H2L8 3z"/>
                </svg>
                <span>Alam &bull; Budaya &bull; Petualangan</span>
            </div>

            {{-- Main Title --}}
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] mb-6 tracking-tight">
                Jelajahi <br>
                <span class="text-[#E8C87D]">Keindahan Jambi,</span> <br>
                Alamnya Memikat Hati
            </h1>

            {{-- Subtitle --}}
            <p class="text-white/90 text-lg md:text-xl max-w-2xl mb-12 leading-relaxed">
                Temukan destinasi terbaik, produk travel terpercaya, dan inspirasi perjalanan untuk petualangan tak terlupakan.
            </p>

            {{-- Buttons --}}
            <div class="flex flex-wrap gap-5">
                {{-- Tombol Primary (Brand Sky -> Ocean) --}}
                <a href="/destinasi" class="inline-flex items-center justify-center gap-3 bg-[#1A6FA8] hover:bg-[#0D3B5E] text-white px-8 py-4 rounded-full text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg border border-[#1A6FA8] hover:border-[#0D3B5E]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
                    </svg>
                    Mulai Jelajahi &rarr;
                </a>
                
                {{-- Tombol Secondary (Glassmorphism -> Solid White dengan teks Ocean) --}}
                <a href="/toko" class="inline-flex items-center justify-center gap-3 bg-white/10 hover:bg-white backdrop-blur-md text-white hover:text-[#0D3B5E] border border-white/50 px-8 py-4 rounded-full text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    Kunjungi Toko Outdoor &rarr;
                </a>
            </div>
        </div>
    </section>

    {{-- SECTION BERITA --}}
    <section class="mb-20">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#0A1628] tracking-tight">Berita Terkini</h2>
                <p class="text-gray-500 mt-2 text-base md:text-lg">Update terbaru seputar destinasi dan perjalanan</p>
            </div>
            <a href="/berita" class="text-[#1A6FA8] font-bold hover:text-[#0D3B5E] hover:underline transition-colors hidden sm:block">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($beritaTerbaru as $item)
                <div class="group bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="relative overflow-hidden h-52">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            {{-- Fallback menggunakan Brand Mist --}}
                            <div class="bg-[#F2F6FA] h-full flex items-center justify-center text-5xl">📰</div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest text-[#0D3B5E]">
                            {{ $item->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-[#0A1628] group-hover:text-[#1A6FA8] transition-colors line-clamp-2 leading-snug">{{ $item->title }}</h3>
                        <p class="text-gray-500 text-sm mt-3 line-clamp-2 leading-relaxed">{{ strip_tags($item->content) }}</p>
                        <a href="/berita/{{ $item->id }}" class="mt-4 inline-flex items-center gap-2 text-[#1A6FA8] font-bold text-sm">
                            Baca Selengkapnya <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 col-span-3 text-center py-8">Belum ada berita terbaru saat ini.</p>
            @endforelse
        </div>
    </section>

    {{-- SECTION DESTINASI UNGGULAN --}}
    <section class="mb-20">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#0A1628] tracking-tight">Destinasi Unggulan</h2>
                <p class="text-gray-500 mt-2 text-base md:text-lg">Tempat-tempat terbaik yang wajib Anda kunjungi</p>
            </div>
            <a href="/destinasi" class="text-[#1A6FA8] font-bold hover:text-[#0D3B5E] hover:underline transition-colors hidden sm:block">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($destinations as $destination)
                <div class="group bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="relative overflow-hidden h-52">
                        @if($destination->image)
                            <img src="{{ asset('storage/' . $destination->image) }}" alt="Foto {{ $destination->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="bg-[#F2F6FA] h-full flex items-center justify-center text-5xl">🏝️</div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-[#0A1628] group-hover:text-[#1A6FA8] transition-colors">{{ $destination->name }}</h3>
                        <p class="text-gray-500 text-sm mt-2 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#D9654A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $destination->location }}
                        </p>
                        <a href="/destinasi/{{ $destination->id }}" class="mt-4 inline-flex items-center gap-2 text-[#1A6FA8] font-bold text-sm">
                            Lihat Detail <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 col-span-3 text-center py-8">Belum ada destinasi tersedia.</p>
            @endforelse
        </div>
    </section>

    {{-- SECTION PILIHAN POPULER --}}
    <div class="home-popular-section">
        <div class="home-popular-header">
            <div>
                <h2>Pilihan Populer</h2>
                <p class="home-popular-subtitle">Perlengkapan perjalanan terbaik untuk Anda</p>
            </div>
            <a href="/toko" class="home-see-all">Lihat Semua &rarr;</a>
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
                <p style="color:#999; font-size:0.9rem; text-align:center; width:100%; padding: 2rem 0;">Belum ada produk tersedia.</p>
                @endforelse
            </div>

            <button class="home-carousel-arrow home-arrow-right" id="homePopularNext" type="button" aria-label="Selanjutnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>

    {{-- CSS & JS khusus Pilihan Populer di Beranda (Diselaraskan dengan Palette) --}}
    <style>
        .home-popular-section {
            margin-top: 3rem;
            padding: 3rem 0 0;
            border-top: 1px solid rgba(13, 59, 94, 0.1); /* Menggunakan alpha brand-ocean */
        }
        .home-popular-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
        }
        .home-popular-header h2 {
            font-size: 1.875rem; /* setara text-3xl */
            font-weight: 800;
            margin: 0;
            color: #0A1628; /* --brand-ink */
            letter-spacing: -0.025em;
        }
        .home-popular-subtitle {
            color: #6b7280;
            font-size: 1rem;
            margin: 0.5rem 0 0;
        }
        .home-see-all {
            font-size: 0.875rem;
            font-weight: 700;
            color: #1A6FA8; /* --brand-sky */
            text-decoration: none;
            transition: color 0.25s;
            white-space: nowrap;
            margin-bottom: 0.25rem;
        }
        .home-see-all:hover { color: #0D3B5E; /* --brand-ocean */ text-decoration: underline; }

        .home-popular-carousel-wrap {
            position: relative;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .home-carousel-arrow {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1px solid rgba(13, 59, 94, 0.15);
            background: #fff;
            color: #0D3B5E;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s;
            z-index: 3;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .home-carousel-arrow:hover {
            background: #F2F6FA; /* --brand-mist */
            border-color: #1A6FA8; /* --brand-sky */
            color: #1A6FA8;
        }
        .home-popular-carousel {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
            flex: 1;
            padding: 8px 0 16px;
        }
        .home-popular-carousel::-webkit-scrollbar { display: none; }

        .home-popular-card {
            flex: 0 0 220px;
            background: #fff;
            border: 1px solid rgba(13, 59, 94, 0.08);
            border-radius: 16px;
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .home-popular-card:hover {
            box-shadow: 0 10px 25px rgba(13, 59, 94, 0.08);
            border-color: rgba(26, 111, 168, 0.3); /* --brand-sky alpha */
            transform: translateY(-4px);
        }
        .home-popular-card-image {
            width: 100%;
            aspect-ratio: 1/1;
            border-radius: 10px;
            overflow: hidden;
            background: #F2F6FA; /* --brand-mist */
        }
        .home-popular-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }
        .home-popular-card:hover .home-popular-card-image img {
            transform: scale(1.08);
        }
        .home-popular-card-info strong {
            display: block;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.4;
            color: #0A1628; /* --brand-ink */
            margin-bottom: 6px;
            transition: color 0.2s;
        }
        .home-popular-card:hover .home-popular-card-info strong {
            color: #1A6FA8; /* --brand-sky */
        }
        .home-popular-price {
            display: block;
            font-size: 15px;
            font-weight: 800;
            color: #0D3B5E; /* --brand-ocean */
            margin-bottom: 6px;
        }
        .home-popular-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
        }
        .home-rating-star { color: #E8C87D; font-size: 14px; } /* --brand-sand */

        @media (max-width: 600px) {
            .home-popular-card { flex: 0 0 170px; padding: 10px; }
            .home-carousel-arrow { display: none; }
            .home-popular-header h2 { font-size: 1.5rem; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('homePopularCarousel');
            const prevBtn = document.getElementById('homePopularPrev');
            const nextBtn = document.getElementById('homePopularNext');
            if (carousel && prevBtn && nextBtn) {
                const scrollAmount = 240;
                prevBtn.addEventListener('click', () => carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' }));
                nextBtn.addEventListener('click', () => carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' }));
            }
        });
    </script>

@endsection