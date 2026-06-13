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

            {{-- WADAH PETA DITAMBAHKAN DI SINI --}}
            @if($destination->latitude && $destination->longitude)
                <div class="mt-8 border-t border-gray-100 pt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Lokasi di Peta</h2>
                    <div id="map" class="w-full h-96 rounded-xl shadow border border-gray-200 relative z-0"></div>
                </div>
            @endif
        </div>
    </div>

    {{-- Tombol Hapus: Hanya muncul jika yang login adalah Admin --}}
@role('Admin')
    <form action="{{ route('admin.destinasi.destroy', $destination->id) }}" method="POST" onsubmit="return confirm('Peringatan: Apakah Anda yakin ingin menghapus destinasi ini secara permanen?');" style="margin-top: 1.5rem;">
        @csrf
        @method('DELETE')
        <button type="submit" style="background-color: var(--brand-coral); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-weight: 500; cursor: pointer; transition: background 0.2s;">
            <svg style="width: 16px; height: 16px; display: inline-block; vertical-align: text-bottom; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Destinasi
        </button>
    </form>
@endrole

@endsection {{-- Section Content Ditutup Di Sini --}}


{{-- Script untuk menjalankan Leaflet --}}
@push('scripts')
@if($destination->latitude && $destination->longitude)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Ambil koordinat dari database
        var lat = {{ $destination->latitude }};
        var lng = {{ $destination->longitude }};

        // 2. Inisialisasi peta dan pusatkan ke koordinat destinasi
        var map = L.map('map').setView([lat, lng], 13); // Angka 13 adalah level zoom

        // 3. Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // 4. Tambahkan Marker (Pin)
        L.marker([lat, lng]).addTo(map)
            .bindPopup("<b>{{ $destination->name }}</b><br>{{ $destination->location }}") // Teks saat pin diklik
            .openPopup();
    });
</script>
@endif
@endpush {{-- Push Scripts Ditutup Di Sini --}}