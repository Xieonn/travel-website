@extends('layouts.app')

@section('title', 'Berita & Inspirasi')

@section('content')

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Explore stories across the world</h1>
        <p class="text-gray-500 mt-2">Temukan inspirasi perjalanan dari seluruh penjuru dunia</p>
    </div>

    {{-- Filter Kategori --}}
    <div class="flex gap-3 mb-8 flex-wrap">
        <a href="/berita"
           class="px-4 py-2 rounded-full text-sm font-medium
           {{ !request('category') ? 'bg-gray-800 text-white' : 'border border-gray-300 text-gray-600 hover:bg-gray-100' }}">
            Semua
        </a>
        @foreach(['Tips', 'Destinasi', 'Petualangan', 'Kuliner', 'Budaya'] as $cat)
            <a href="/berita?category={{ $cat }}"
               class="px-4 py-2 rounded-full text-sm font-medium
               {{ request('category') == $cat ? 'bg-gray-800 text-white' : 'border border-gray-300 text-gray-600 hover:bg-gray-100' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    {{-- Grid Artikel --}}
    <div class="grid grid-cols-4 gap-6">
        @forelse($posts as $post)
            <a href="/berita/{{ $post->id }}" class="group block">
                
                {{-- Thumbnail Gambar / Backup Emoji --}}
                <div class="rounded-xl overflow-hidden aspect-video flex items-center justify-center text-4xl mb-3 bg-gray-100 relative">
                    @if($post->thumbnail)
                        {{-- Jika ada gambar hasil upload --}}
                        <img src="{{ asset('storage/' . $post->thumbnail) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300"/>
                    @else
                        {{-- Jika gambar kosong, tampilkan background & emoji sesuai kategori --}}
                        <div class="w-full h-full flex items-center justify-center 
                            @if($post->category == 'Tips') bg-blue-100
                            @elseif($post->category == 'Destinasi') bg-green-100
                            @elseif($post->category == 'Petualangan') bg-orange-100
                            @elseif($post->category == 'Kuliner') bg-red-100
                            @else bg-purple-100 @endif">
                            
                            @if($post->category == 'Tips') 💡
                            @elseif($post->category == 'Destinasi') 🏝️
                            @elseif($post->category == 'Petualangan') 🏔️
                            @elseif($post->category == 'Kuliner') 🍜
                            @else 📰 @endif
                        </div>
                    @endif
                </div>

                {{-- Info Artikel --}}
                <span class="text-xs text-orange-600 font-semibold uppercase tracking-wide">
                    {{ $post->category }}
                </span>
                <h3 class="font-bold text-gray-800 mt-1 group-hover:text-orange-600 transition leading-snug">
                    {{ $post->title }}
                </h3>
                <p class="text-gray-400 text-xs mt-1">
                    {{ $post->created_at->format('d M Y') }} · {{ $post->user->name }}
                </p>
            </a>
        @empty
            <div class="col-span-4 text-center py-16 text-gray-400">
                <p class="text-5xl mb-4">📭</p>
                <p class="text-xl">Belum ada artikel tersedia.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $posts->links() }}
    </div>

@endsection