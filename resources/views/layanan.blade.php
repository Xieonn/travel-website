{{-- Mengambil master layout --}}
@extends('layouts.app')

@section('title', 'Pusat Bantuan & Kontak')

@push('styles')
<style>
    /* ── HELP CENTER SPECIFIC STYLES ─────────────────────────── */
    .help-hero {
        text-align: center;
        padding: 5rem 2rem;
        background: linear-gradient(135deg, rgba(26,111,168,0.04), rgba(13,59,94,0.08));
        border-radius: 24px;
        margin-bottom: 4rem;
    }

    .help-hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3.5rem;
        color: var(--brand-ocean);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .help-hero p {
        font-size: 1.125rem;
        color: #4A5568;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Grid Kartu Kontak */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 5rem;
    }

    .contact-card {
        background: white;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13,59,94,0.04);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(13,59,94,0.08);
    }

    .contact-icon {
        width: 60px;
        height: 60px;
        background: rgba(26, 111, 168, 0.1); /* --brand-sky dengan opacity */
        color: var(--brand-sky);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
    }

    .contact-icon svg {
        width: 28px;
        height: 28px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .contact-card h3 {
        color: var(--brand-ink);
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
    }

    .contact-card p, .contact-card a {
        color: #4A5568;
        font-size: 1rem;
        text-decoration: none;
        line-height: 1.6;
    }

    .contact-card a {
        font-weight: 500;
        color: var(--brand-ocean);
        transition: color 0.2s;
    }

    .contact-card a:hover {
        color: var(--brand-coral);
    }

    /* Bagian Formulir Bantuan */
    .contact-form-section {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(13,59,94,0.05);
    }

    .contact-form-section h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.25rem;
        color: var(--brand-ocean);
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .contact-form-section > p {
        text-align: center;
        color: #4A5568;
        margin-bottom: 2.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--brand-ink);
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1px solid rgba(13,59,94,0.15);
        border-radius: 10px;
        font-family: inherit;
        font-size: 1rem;
        color: var(--brand-ink);
        transition: all 0.2s;
        background: #FAFCFF;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--brand-sky);
        box-shadow: 0 0 0 4px rgba(26,111,168,0.1);
        background: white;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 1rem;
        background: var(--brand-ocean);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 500;
        font-family: inherit;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
    }

    .btn-submit:hover {
        background: var(--brand-sky);
        transform: translateY(-2px);
    }

    /* Responsivitas untuk mobile */
    @media (max-width: 768px) {
        .help-hero h1 { font-size: 2.5rem; }
        .contact-form-section { padding: 2rem 1.5rem; }
    }
</style>
@endpush

@section('content')

    {{-- Bagian Header Bantuan --}}
    <section class="help-hero">
        <h1>Pusat Bantuan</h1>
        <p>Ada pertanyaan terkait destinasi, pemesanan, atau kendala teknis? Kami di sini siap membantu Anda kapan saja.</p>
    </section>

    {{-- Grid Informasi Kontak --}}
    <section class="contact-grid">
        
        {{-- Telepon --}}
        <div class="contact-card">
            <div class="contact-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
            </div>
            <h3>Telepon</h3>
            <p>Senin - Sabtu, 09:00 - 15:00</p>
            <a href="tel:+62895359609623">+62 895 3596 09623</a>
        </div>

        {{-- WhatsApp --}}
        <div class="contact-card">
            <div class="contact-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                </svg>
            </div>
            <h3>WhatsApp</h3>
            <p>Layanan Cepat 24/7</p>
            <a href="https://wa.me/6285368342347" target="_blank">+62 85 3683 4234</a>
        </div>

        {{-- Email --}}
        <div class="contact-card">
            <div class="contact-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </div>
            <h3>Email</h3>
            <p>Tanya seputar kerjasama/umum</p>
            <a href="mailto:halo@travelkami.com">halo@travelkami.com</a>
        </div>

    </section>

@endsection