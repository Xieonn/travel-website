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

    {{-- Section Produk Terbaru --}}
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Produk Travel</h2>
        <p class="text-gray-500 mb-6">Perlengkapan perjalanan terbaik untuk Anda</p>

        <div class="grid grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                    <div class="bg-green-100 h-36 flex items-center justify-center text-4xl">🎒</div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-green-600 font-semibold mt-1">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <a href="/toko/{{ $product->id }}"
                           class="mt-2 inline-block text-blue-600 hover:underline text-sm">
                            Lihat Produk →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 col-span-4">Belum ada produk tersedia.</p>
            @endforelse
        </div>
    </div>

@endsection