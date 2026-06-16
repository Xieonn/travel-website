@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <a href="/berita" class="text-orange-500 hover:underline text-sm">← Kembali ke Berita</a>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mt-4">
        {{-- Hero Gambar / Backup Emoji --}}
        <div class="h-72 w-full flex items-center justify-center overflow-hidden bg-gray-100 relative">
<<<<<<< HEAD
            @if($post->thumbnail)
                {{-- Jika ada gambar hasil upload, tampilkan gambarnya secara penuh --}}
=======
            @if($post->thumbnail && file_exists(public_path('storage/' . $post->thumbnail)))
>>>>>>> Fitur-Berita
                <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-full object-cover">
            @else
<<<<<<< HEAD
                {{-- Jika tidak ada gambar, tampilkan background gradient & emoji cadangan --}}
                <div class="w-full h-full flex items-center justify-center text-8xl text-white
                    @if($post->category == 'Tips') bg-gradient-to-r from-blue-300 to-blue-500
                    @elseif($post->category == 'Destinasi') bg-gradient-to-r from-green-300 to-green-500
=======
                <div class="w-full h-full flex items-center justify-center text-8xl text-white
                    @if($post->category == 'Tips') bg-gradient-to-r from-blue-300 to-blue-500
                    @elseif($post->category == 'Destinasi' || $post->category == 'Wisata Alam') bg-gradient-to-r from-green-300 to-green-500
>>>>>>> Fitur-Berita
                    @elseif($post->category == 'Petualangan') bg-gradient-to-r from-orange-300 to-orange-500
                    @elseif($post->category == 'Kuliner') bg-gradient-to-r from-red-300 to-red-500
                    @else bg-gradient-to-r from-purple-300 to-purple-500 @endif">
                    
                    @if($post->category == 'Tips') 💡
<<<<<<< HEAD
                    @elseif($post->category == 'Destinasi') 🏝️
=======
                    @elseif($post->category == 'Destinasi' || $post->category == 'Wisata Alam') 🏝️
>>>>>>> Fitur-Berita
                    @elseif($post->category == 'Petualangan') 🏔️
                    @elseif($post->category == 'Kuliner') 🍜
                    @else 📰 @endif
                </div>
            @endif
        </div>

        {{-- Konten Berita --}}
        <div class="p-8">
            <span class="text-sm bg-orange-100 text-orange-700 px-3 py-1 rounded-full font-medium">
                {{ $post->category }}
            </span>
            <h1 class="text-4xl font-bold text-gray-800 mt-3">{{ $post->title }}</h1>
            <p class="text-gray-500 mt-2">
                ✍️ {{ $post->user->name }} · {{ $post->created_at->format('d M Y') }}
            </p>
            <div class="mt-6 text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                {{ $post->content }}
            </div>
        </div>
    </div>

@endsection