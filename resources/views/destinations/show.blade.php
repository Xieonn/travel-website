@extends('layouts.app')

@section('title', $destination->name)

@section('content')

    <a href="/destinasi" class="text-blue-600 hover:underline text-sm">← Kembali ke Destinasi</a>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mt-4">

        {{-- Hero Image --}}
        <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-64 flex items-center justify-center text-8xl">
            🏝️
        </div>

        <div class="p-8">
            <span class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                {{ $destination->category }}
            </span>
            <h1 class="text-4xl font-bold text-gray-800 mt-3">{{ $destination->name }}</h1>
            <p class="text-gray-500 mt-2 text-lg">📍 {{ $destination->location }}</p>

            <div class="mt-6 text-gray-700 leading-relaxed">
                {{ $destination->description }}
            </div>
        </div>
    </div>

@endsection