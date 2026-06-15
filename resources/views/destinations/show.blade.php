@extends('layouts.app')

@section('title', $destination->name)

@push('styles')
<style>
    /* ── NAVIGASI KEMBALI ────────────────────────────────────── */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #4A5568;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        color: var(--brand-ocean);
        transform: translateX(-4px); 
    }

    /* ── WADAH UTAMA ─────────────────────────────────────────── */
    .dest-detail-wrapper {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(13,59,94,0.05);
        overflow: hidden;
    }

    /* ── GAMBAR HERO ─────────────────────────────────────────── */
    .dest-hero {
        height: 450px;
        width: 100%;
        position: relative;
        background: var(--brand-mist);
    }

    .dest-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dest-hero-fallback {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, var(--brand-sky), var(--brand-ocean));
        font-size: 5rem;
    }

    /* ── KONTEN DETAIL ───────────────────────────────────────── */
    .dest-content-area {
        padding: 3.5rem 4rem;
    }

    .badge-category {
        display: inline-block;
        background: rgba(26,111,168,0.1);
        color: var(--brand-sky);
        padding: 0.4rem 1.25rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }

    .title-large {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        color: var(--brand-ink);
        margin: 0 0 0.5rem;
        line-height: 1.2;
    }

    .location-text {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--brand-coral);
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 2.5rem;
    }

    .location-text svg {
        width: 20px;
        height: 20px;
        fill: currentColor;
    }

    .desc-text {
        color: #4A5568;
        font-size: 1.05rem;
        line-height: 1.8;
        margin-bottom: 3.5rem;
    }

    /* ── BAGIAN PETA ─────────────────────────────────────────── */
    .map-wrapper {
        border-top: 1px solid rgba(13,59,94,0.1);
        padding-top: 3rem;
    }

    .map-wrapper h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.25rem;
        color: var(--brand-ink);
        margin-bottom: 1.5rem;
    }

    .map-box {
        width: 100%;
        height: 450px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid rgba(13,59,94,0.08);
        z-index: 1; /* Mencegah Leaflet menutupi elemen lain */
    }

    /* ── PANEL ADMIN ─────────────────────────────────────────── */
    .admin-panel {
        margin-top: 2.5rem;
        padding: 1.5rem 2rem;
        background: rgba(217,101,74,0.03);
        border: 1px dashed rgba(217,101,74,0.3);
        border-radius: 16px;
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .admin-panel-title {
        font-size: 0.875rem;
        color: var(--brand-coral);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-right: auto;
    }

    .btn-admin {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.7rem 1.25rem;
        border-radius: 10px;
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
        font-family: 'DM Sans', sans-serif;
    }

    .btn-edit {
        background: var(--brand-ocean);
        color: white;
    }

    .btn-edit:hover {
        background: var(--brand-sky);
        transform: translateY(-2px);
    }

    .btn-delete {
        background: white;
        color: var(--brand-coral);
        border: 1px solid rgba(217,101,74,0.4);
    }

    .btn-delete:hover {
        background: rgba(217,101,74,0.05);
        border-color: var(--brand-coral);
        transform: translateY(-2px);
    }

    /* ── RESPONSIVITAS ───────────────────────────────────────── */
    @media (max-width: 768px) {
        .dest-content-area { padding: 2rem 1.5rem; }
        .title-large { font-size: 2.25rem; }
        .dest-hero { height: 250px; }
        .admin-panel { flex-direction: column; align-items: stretch; }
        .admin-panel-title { margin-bottom: 0.5rem; }
    }
</style>
@endpush

@section('content')

    {{-- Tombol Kembali --}}
    <a href="/destinasi" class="btn-back">
        <svg viewBox="0 0 24 24" style="width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali ke Daftar Destinasi
    </a>

    {{-- Wadah Utama --}}
    <article class="dest-detail-wrapper">

        {{-- Hero Image (Menampilkan Foto Asli) --}}
        <div class="dest-hero">
            @if($destination->image)
                <img src="{{ asset('storage/' . $destination->image) }}" alt="Foto {{ $destination->name }}">
            @else
                <div class="dest-hero-fallback">
                    🏝️
                </div>
            @endif
        </div>

        {{-- Konten Utama --}}
        <div class="dest-content-area">
            <span class="badge-category">{{ $destination->category }}</span>
            <h1 class="title-large">{{ $destination->name }}</h1>
            
            <div class="location-text">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"></path>
                </svg>
                <span>{{ $destination->location }}</span>
            </div>

            <div class="desc-text">
                {!! nl2br(e($destination->description)) !!}
            </div>

            {{-- WADAH PETA --}}
            @if($destination->latitude && $destination->longitude)
                <div class="map-wrapper">
                    <h2>Lokasi di Peta</h2>
                    <div id="map" class="map-box"></div>
                </div>
            @endif

            {{-- Aksi Khusus Admin --}}
            @role('Admin')
                <div class="admin-panel">
                    <span class="admin-panel-title">Panel Kontrol Admin</span>

                    {{-- Tombol Edit --}}
                    <a href="{{ route('admin.destinasi.edit', $destination->id) }}" class="btn-admin btn-edit">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit Destinasi
                    </a>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('admin.destinasi.destroy', $destination->id) }}" method="POST" onsubmit="return confirm('Peringatan: Apakah Anda yakin ingin menghapus destinasi ini secara permanen?');" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-admin btn-delete">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus Destinasi
                        </button>
                    </form>
                </div>
            @endrole

        </div>
    </article>

@endsection

@push('scripts')
@if($destination->latitude && $destination->longitude)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Ambil koordinat dari database
        var lat = {{ $destination->latitude }};
        var lng = {{ $destination->longitude }};

        // 2. Inisialisasi peta dan pusatkan ke koordinat destinasi
        var map = L.map('map').setView([lat, lng], 13);

        // 3. Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // 4. Tambahkan Marker (Pin)
        L.marker([lat, lng]).addTo(map)
            .bindPopup("<b>{{ $destination->name }}</b><br>{{ $destination->location }}")
            .openPopup();
    });
</script>
@endif
@endpush