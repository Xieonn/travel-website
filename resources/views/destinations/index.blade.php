@extends('layouts.app')

@section('title', 'Destinasi')

@section('content')

    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">🏝️ Destinasi Wisata</h1>
        <p class="text-gray-500 mt-2">Temukan tempat-tempat menakjubkan yang menanti Anda</p>
    </div>

    <div class="grid grid-cols-3 gap-6">
        @forelse($destinations as $destination)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                <div class="bg-blue-100 h-48 flex items-center justify-center text-6xl">🏝️</div>
                <div class="p-5">
                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                        {{ $destination->category }}
                    </span>
                    <h3 class="font-bold text-xl text-gray-800 mt-2">{{ $destination->name }}</h3>
                    <p class="text-gray-500 text-sm mt-1">📍 {{ $destination->location }}</p>
                    <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ $destination->description }}</p>
                    <a href="/destinasi/{{ $destination->id }}"
                       class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                        Lihat Detail →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-gray-400">
                <p class="text-5xl mb-4">🗺️</p>
                <p class="text-xl">Belum ada destinasi tersedia.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $destinations->links() }}
    </div>

@endsection