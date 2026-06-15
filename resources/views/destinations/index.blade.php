@extends('layouts.app')

@section('title', 'Destinasi Wisata')

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
        /* Efek bergeser ke kiri sedikit saat di-hover */
        transform: translateX(-4px); 
    }

    .btn-back svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    /* ── DESTINATIONS HERO ───────────────────────────────────── */
    .destinations-hero {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(135deg, rgba(13,59,94,0.03), rgba(232,200,125,0.08));
        border-radius: 24px;
        margin-bottom: 4rem;
    }

    .destinations-hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3.5rem;
        color: var(--brand-ocean);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .destinations-hero p {
        font-size: 1.125rem;
        color: #4A5568;
        max-width: 600px;
        margin: 0 auto;
    }

    /* ── DESTINATIONS GRID & CARDS ───────────────────────────── */
    .destinations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2.5rem;
        margin-bottom: 4rem;
    }

    .dest-card {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(13,59,94,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .dest-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(13,59,94,0.1);
    }

    .dest-img-wrapper {
        position: relative;
        height: 240px;
        width: 100%;
        background: var(--brand-mist);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .dest-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .dest-card:hover .dest-img-wrapper img {
        transform: scale(1.05);
    }

    .dest-badge {
        position: absolute;
        top: 1.25rem;
        left: 1.25rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(4px);
        color: var(--brand-ocean);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.4rem 0.85rem;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        z-index: 2;
    }

    .dest-content {
        padding: 1.75rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .dest-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.75rem;
        color: var(--brand-ink);
        margin: 0 0 0.5rem;
        line-height: 1.3;
    }

    .dest-location {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--brand-coral);
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .dest-location svg {
        width: 16px;
        height: 16px;
        fill: currentColor;
    }

    .dest-desc {
        color: #4A5568;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--brand-mist);
        color: var(--brand-ocean);
        text-decoration: none;
        padding: 0.85rem;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        margin-top: auto;
    }

    .btn-detail:hover {
        background: var(--brand-ocean);
        color: white;
    }

    /* ── EMPTY STATE ─────────────────────────────────────────── */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 6rem 2rem;
        background: white;
        border-radius: 20px;
        border: 2px dashed rgba(13,59,94,0.1);
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        color: rgba(13,59,94,0.2);
        margin: 0 auto 1.5rem;
    }

    .empty-state p {
        color: #718096;
        font-size: 1.125rem;
    }

    @media (max-width: 768px) {
        .destinations-hero h1 { font-size: 2.5rem; }
        .destinations-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

    {{-- Tombol Kembali ke Beranda --}}
    <a href="/" class="btn-back">
        <svg viewBox="0 0 24 24">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali ke Beranda
    </a>

    {{-- Bagian Header Destinasi --}}
    <section class="destinations-hero">
        <h1>Jelajahi Keajaiban Dunia</h1>
        <p>Temukan berbagai destinasi menakjubkan yang telah kami kurasi khusus untuk pengalaman liburan Anda selanjutnya.</p>
    </section>

    {{-- Grid Kartu Destinasi --}}
    <div class="destinations-grid">
        @forelse($destinations as $destination)
            <article class="dest-card">
                
                {{-- Gambar & Kategori --}}
                <div class="dest-img-wrapper">
                    @if($destination->category)
                        <span class="dest-badge">{{ $destination->category }}</span>
                    @endif

                    @if($destination->image)
                        <img src="{{ asset('storage/' . $destination->image) }}" alt="Foto {{ $destination->name }}">
                    @else
                        {{-- Fallback icon jika gambar tidak ada --}}
                        <svg style="width:48px; height:48px; color:rgba(26,111,168,0.2);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    @endif
                </div>

                {{-- Konten Teks --}}
                <div class="dest-content">
                    <h3 class="dest-title">{{ $destination->name }}</h3>
                    
                    <div class="dest-location">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"></path>
                        </svg>
                        <span>{{ $destination->location }}</span>
                    </div>

                    <p class="dest-desc">{{ $destination->description }}</p>

                    <a href="/destinasi/{{ $destination->id }}" class="btn-detail">
                        Lihat Detail
                        <svg style="width:16px; height:16px; fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round;" viewBox="0 0 24 24">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </article>

        @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <p>Belum ada destinasi yang tersedia saat ini.<br>Silakan kembali lagi nanti!</p>
            </div>
        @endforelse
    </div>

    {{-- Penomoran Halaman (Pagination) --}}
    @if($destinations->hasPages())
        <div style="display:flex; justify-content:center; margin-top:2rem;">
            {{ $destinations->links() }}
        </div>
    @endif

@endsection