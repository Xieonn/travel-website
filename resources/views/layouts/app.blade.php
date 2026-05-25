<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand-ocean:   #0D3B5E;
            --brand-sky:     #1A6FA8;
            --brand-sand:    #E8C87D;
            --brand-mist:    #F2F6FA;
            --brand-ink:     #0A1628;
            --brand-coral:   #D9654A;
            --nav-height:    72px;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--brand-mist);
            color: var(--brand-ink);
            margin: 0;
        }

        /* ── NAVBAR ─────────────────────────────────────────── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            height: var(--nav-height);
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(13,59,94,0.08);
            transition: background 0.3s, box-shadow 0.3s;
        }

        .navbar.scrolled {
            background: rgba(255,255,255,0.97);
            box-shadow: 0 2px 24px rgba(13,59,94,0.10);
        }

        .navbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        /* Logo */
        .nav-logo {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .nav-logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--brand-sky), var(--brand-ocean));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-logo-icon svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        .nav-logo-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.45rem;
            font-weight: 600;
            color: var(--brand-ocean);
            letter-spacing: -0.02em;
        }

        /* Nav Links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .nav-link {
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            color: #4A5568;
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            letter-spacing: 0.01em;
            transition: color 0.2s, background 0.2s;
            white-space: nowrap;
        }

        .nav-link:hover {
            color: var(--brand-ocean);
            background: rgba(13,59,94,0.06);
        }

        .nav-link.active {
            color: var(--brand-ocean);
            font-weight: 500;
        }

        /* Nav Divider */
        .nav-divider {
            width: 1px;
            height: 20px;
            background: rgba(13,59,94,0.12);
            margin: 0 0.5rem;
            flex-shrink: 0;
        }

        /* Cart Badge */
        .nav-cart {
            position: relative;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            color: #4A5568;
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            transition: color 0.2s, background 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-cart:hover {
            color: var(--brand-ocean);
            background: rgba(13,59,94,0.06);
        }

        .cart-icon {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Role Badges */
        .badge-admin {
            font-size: 0.775rem;
            font-weight: 500;
            color: var(--brand-coral);
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            border: 1px solid rgba(217,101,74,0.3);
            background: rgba(217,101,74,0.06);
            text-decoration: none;
            transition: background 0.2s;
        }

        .badge-admin:hover { background: rgba(217,101,74,0.12); }

        .badge-seller {
            font-size: 0.775rem;
            font-weight: 500;
            color: #1A7A4A;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            border: 1px solid rgba(26,122,74,0.3);
            background: rgba(26,122,74,0.06);
            text-decoration: none;
            transition: background 0.2s;
        }

        .badge-seller:hover { background: rgba(26,122,74,0.12); }

        /* Auth Buttons */
        .btn-logout {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.825rem;
            font-weight: 500;
            color: #4A5568;
            background: transparent;
            border: 1px solid rgba(74,85,104,0.25);
            padding: 0.4rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            color: var(--brand-coral);
            border-color: var(--brand-coral);
            background: rgba(217,101,74,0.05);
        }

        .btn-login {
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            color: #4A5568;
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            transition: color 0.2s, background 0.2s;
        }

        .btn-login:hover {
            color: var(--brand-ocean);
            background: rgba(13,59,94,0.06);
        }

        .btn-register {
            text-decoration: none;
            font-size: 0.825rem;
            font-weight: 500;
            color: white;
            background: var(--brand-ocean);
            padding: 0.45rem 1.25rem;
            border-radius: 8px;
            letter-spacing: 0.01em;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-register:hover {
            background: var(--brand-sky);
            transform: translateY(-1px);
        }

        /* ── PAGE ANNOUNCEMENT BAR (optional slot) ──────────── */
        .announcement-bar {
            background: var(--brand-ocean);
            color: rgba(255,255,255,0.9);
            font-size: 0.8rem;
            text-align: center;
            padding: 8px 1rem;
            letter-spacing: 0.02em;
        }

        .announcement-bar a {
            color: var(--brand-sand);
            text-decoration: none;
            font-weight: 500;
        }

        /* ── MAIN CONTENT ────────────────────────────────────── */
        .page-main {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.5rem 2rem 4rem;
        }

        /* ── FOOTER ──────────────────────────────────────────── */
        footer {
            background: var(--brand-ink);
            color: rgba(255,255,255,0.75);
            margin-top: 5rem;
        }

        .footer-top {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4rem 2rem 3rem;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
        }

        .footer-brand .footer-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .footer-brand p {
            font-size: 0.875rem;
            line-height: 1.7;
            color: rgba(255,255,255,0.55);
            max-width: 260px;
            margin: 0 0 1.5rem;
        }

        .footer-socials {
            display: flex;
            gap: 10px;
        }

        .footer-social-link {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .footer-social-link:hover {
            border-color: var(--brand-sand);
            color: var(--brand-sand);
        }

        .footer-col h4 {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.4);
            margin: 0 0 1rem;
        }

        .footer-col ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .footer-col a {
            text-decoration: none;
            font-size: 0.875rem;
            color: rgba(255,255,255,0.6);
            transition: color 0.2s;
        }

        .footer-col a:hover { color: white; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.07);
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.25rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.3);
        }

        .footer-bottom a {
            color: rgba(255,255,255,0.3);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-bottom a:hover { color: rgba(255,255,255,0.6); }

        /* ── FLASH MESSAGES ──────────────────────────────────── */
        .flash {
            padding: 0.875rem 1.25rem;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flash-success {
            background: rgba(16,185,129,0.08);
            border: 1px solid rgba(16,185,129,0.25);
            color: #065F46;
        }

        .flash-error {
            background: rgba(239,68,68,0.07);
            border: 1px solid rgba(239,68,68,0.2);
            color: #991B1B;
        }

        /* ── SCROLL NAV ──────────────────────────────────────── */
        @media (max-width: 900px) {
            .nav-links { display: none; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 600px) {
            .footer-top { grid-template-columns: 1fr; gap: 2rem; }
            .page-main { padding: 1.5rem 1rem 3rem; }
            .navbar-inner { padding: 0 1rem; }
        }
    </style>
</head>
<body>

    {{-- ANNOUNCEMENT BAR (opsional, hapus jika tidak dipakai) --}}
    {{-- <div class="announcement-bar">✈️ Promo Akhir Tahun — Hemat hingga 40% untuk paket wisata pilihan. <a href="/toko">Lihat Penawaran →</a></div> --}}

    {{-- ────────────────────────────────────────── NAVBAR ──── --}}
    <nav class="navbar" id="mainNav">
        <div class="navbar-inner">

            {{-- Logo --}}
            <a href="/" class="nav-logo">
                <div class="nav-logo-icon">
                    {{-- Compass icon --}}
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.535 6.464l-4.243 1.415-1.414 4.243-1.414-4.243-4.243-1.415 4.243-1.414 1.414-4.243 1.414 4.243z"/>
                    </svg>
                </div>
                <span class="nav-logo-text">{{ config('app.name', 'Travel Website') }}</span>
            </a>

            {{-- Nav Links --}}
            <div class="nav-links">
                <a href="/" class="nav-link">Beranda</a>
                <a href="/destinasi" class="nav-link">Destinasi</a>
                <a href="/toko" class="nav-link">Toko</a>
                <a href="/berita" class="nav-link">Berita</a>

                <div class="nav-divider"></div>

                @auth
                    {{-- Keranjang --}}
                    <a href="/keranjang" class="nav-cart">
                        <svg class="cart-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <path d="M16 10a4 4 0 01-8 0"/>
                        </svg>
                        Keranjang
                    </a>

                    @if(auth()->user()->isAdmin())
                        <a href="/admin/dashboard" class="badge-admin">Admin</a>
                    @endif

                    @if(auth()->user()->isSeller())
                        <a href="/seller/dashboard" class="badge-seller">Seller</a>
                    @endif

                    <form method="POST" action="/logout" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Keluar</button>
                    </form>
                @else
                    <a href="/login" class="btn-login">Masuk</a>
                    <a href="/register" class="btn-register">Daftar Gratis</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ──────────────────────────────── FLASH MESSAGES ──── --}}
    @if(session('success') || session('error'))
    <div style="max-width:1280px; margin:0 auto; padding:0 2rem;">
        @if(session('success'))
            <div class="flash flash-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-error">⚠ {{ session('error') }}</div>
        @endif
    </div>
    @endif

    {{-- ──────────────────────────────── PAGE CONTENT ──── --}}
    <main class="page-main">
        @yield('content')
    </main>

    {{-- ──────────────────────────────────── FOOTER ──── --}}
    <footer>
        <div class="footer-top">

            {{-- Brand --}}
            <div class="footer-brand">
                <a href="/" class="footer-logo">{{ config('app.name', 'Travel Website') }}</a>
                <p>Temukan destinasi impian Anda bersama kami. Kami membantu merencanakan perjalanan yang tak terlupakan.</p>
                <div class="footer-socials">
                    <a href="#" class="footer-social-link" aria-label="Instagram">ig</a>
                    <a href="#" class="footer-social-link" aria-label="Facebook">fb</a>
                    <a href="#" class="footer-social-link" aria-label="Twitter/X">x</a>
                    <a href="#" class="footer-social-link" aria-label="YouTube">yt</a>
                </div>
            </div>

            {{-- Destinasi --}}
            <div class="footer-col">
                <h4>Jelajahi</h4>
                <ul>
                    <li><a href="/destinasi">Semua Destinasi</a></li>
                    <li><a href="/destinasi?kategori=alam">Wisata Alam</a></li>
                    <li><a href="/destinasi?kategori=budaya">Wisata Budaya</a></li>
                    <li><a href="/destinasi?kategori=kuliner">Wisata Kuliner</a></li>
                </ul>
            </div>

            {{-- Layanan --}}
            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="/toko">Toko Produk</a></li>
                    <li><a href="/berita">Berita Travel</a></li>
                    <li><a href="/tentang">Tentang Kami</a></li>
                    <li><a href="/layanan">Pusat Bantuan</a></li>
                </ul>
            </div>

            {{-- Hukum --}}
            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="/privasi">Kebijakan Privasi</a></li>
                    <li><a href="/syarat">Syarat & Ketentuan</a></li>
                    <li><a href="/cookie">Kebijakan Cookie</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} {{ config('app.name', 'Travel Website') }}. Seluruh hak dilindungi.</span>
            <div style="display:flex; gap:1.5rem;">
                <a href="/privasi">Privasi</a>
                <a href="/syarat">Syarat</a>
                <a href="/kontak">Kontak</a>
            </div>
        </div>
    </footer>

    {{-- ─────────────────────── SCROLL NAVBAR EFFECT ──── --}}
    <script>
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 20);
        }, { passive: true });
    </script>

</body>
</html>