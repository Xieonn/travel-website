{{-- Mengambil master layout yang sudah Anda buat --}}
{{-- Catatan: Ubah 'layouts.app' sesuai dengan nama file dan folder layout utama Anda --}}
@extends('layouts.app')

{{-- Mengisi @yield('title') pada tag <title> di master layout --}}
@section('title', 'Tentang Kami')

{{-- Menambahkan CSS khusus halaman ini ke dalam @stack('styles') --}}
@push('styles')
<style>
    /* ── ABOUT PAGE SPECIFIC STYLES ──────────────────────────── */
    .about-hero {
        text-align: center;
        padding: 5rem 2rem;
        background: linear-gradient(135deg, rgba(13,59,94,0.03), rgba(26,111,168,0.06));
        border-radius: 24px;
        margin-bottom: 4rem;
    }

    .about-hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3.5rem;
        color: var(--brand-ocean);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .about-hero p {
        font-size: 1.125rem;
        color: #4A5568;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .about-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        margin-bottom: 6rem;
    }

    .about-text h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        color: var(--brand-ink);
        margin-bottom: 1.5rem;
    }

    .about-text p {
        color: #4A5568;
        line-height: 1.8;
        margin-bottom: 1.25rem;
        font-size: 1rem;
    }

    /* Kotak placeholder untuk gambar jika Anda belum memiliki gambar asli */
    .about-image-wrapper {
        position: relative;
        width: 100%;
        height: 450px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(13,59,94,0.1);
        background: linear-gradient(45deg, var(--brand-sky), var(--brand-ocean));
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.5);
    }

    .about-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .core-values {
        text-align: center;
        margin-bottom: 4rem;
    }

    .core-values h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        color: var(--brand-ocean);
        margin-bottom: 3rem;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .value-card {
        background: white;
        padding: 2.5rem 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13,59,94,0.04);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(13,59,94,0.08);
    }

    .value-icon {
        width: 64px;
        height: 64px;
        background: rgba(217, 101, 74, 0.1); /* Menggunakan --brand-coral dengan opacity */
        color: var(--brand-coral);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .value-icon svg {
        width: 32px;
        height: 32px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .value-card h3 {
        color: var(--brand-ink);
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    .value-card p {
        color: #4A5568;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Responsivitas untuk mobile */
    @media (max-width: 768px) {
        .about-section {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }
        
        .about-image-wrapper {
            order: -1; /* Membuat gambar berada di atas teks pada tampilan mobile */
            height: 300px;
        }

        .about-hero h1 {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

{{-- Mengisi @yield('content') pada master layout --}}
@section('content')

    {{-- Bagian Hero (Header Halaman) --}}
    <section class="about-hero">
        <h1>Mengenal Kami Lebih Dekat</h1>
        <p>Kami berdedikasi untuk merangkai perjalanan tak terlupakan, menghubungkan Anda dengan keindahan dunia dan budaya lokal yang otentik.</p>
    </section>

    {{-- Bagian Cerita Kami (Two Columns Layout) --}}
    <section class="about-section">
        <div class="about-text">
            <h2>Misi Kami dalam Menjelajah</h2>
            <p>Didirikan dengan gairah terhadap petualangan, <strong>{{ config('app.name', 'Travel Website') }}</strong> hadir untuk menyederhanakan cara Anda merencanakan liburan. Kami percaya bahwa setiap perjalanan adalah kanvas kosong yang siap dilukis dengan kenangan indah.</p>
            <p>Tim ahli kami bekerja tanpa lelah mengurasi destinasi terbaik, memastikan pengalaman perjalanan yang aman, nyaman, dan meninggalkan kesan mendalam di setiap langkah Anda, mulai dari puncak pegunungan hingga hamparan pasir pantai yang menenangkan.</p>
        </div>
        <div class="about-image-wrapper">
            {{-- Ganti src dengan gambar sungguhan jika sudah ada, misalnya asset('images/about-us.jpg') --}}
            <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Perjalanan bersama tim kami">
        </div>
    </section>

    {{-- Bagian Nilai Inti (Grid Layout) --}}
    <section class="core-values">
        <h2>Nilai Inti Kami</h2>
        <div class="values-grid">
            
            {{-- Card 1 --}}
            <div class="value-card">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3>Keamanan Terjamin</h3>
                <p>Prioritas utama kami adalah kenyamanan dan keselamatan Anda. Setiap rute dan mitra perjalanan telah melalui proses verifikasi yang ketat.</p>
            </div>

            {{-- Card 2 --}}
            <div class="value-card">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 16v-4"></path>
                        <path d="M12 8h.01"></path>
                    </svg>
                </div>
                <h3>Informasi Transparan</h3>
                <p>Tidak ada biaya tersembunyi. Kami menyediakan informasi yang jelas dan komprehensif agar Anda dapat merencanakan dengan tenang.</p>
            </div>

            {{-- Card 3 --}}
            <div class="value-card">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>
                <h3>Pengalaman Otentik</h3>
                <p>Kami merancang setiap perjalanan dengan hati, membawa Anda merasakan budaya lokal yang sesungguhnya di setiap destinasi.</p>
            </div>

        </div>
    </section>

@endsection