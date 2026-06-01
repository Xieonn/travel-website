@extends('layouts.app')

@section('title', 'Toko Outdoor')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">

<style>
    :root {
        --sky: #0ea5e9;
        --emerald: #10b981;
        --surface-dark: #0f172a;
        --text-on-dark: #f1f5f9;
        --text-muted: #94a3b8;
        --border-light: #e2e8f0;
        --border-dark: rgba(255,255,255,0.08);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; }
    h1, h2, h3 { font-family: 'Black Ops One', cursive; }

    /* ── HERO SECTION ── */
    .hero {
        background: linear-gradient(135deg, var(--surface-dark) 0%, #1a2947 100%);
        border-radius: 32px;
        padding: clamp(2rem, 5vw, 4rem);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 80% 20%, rgba(14,165,233,0.15) 0%, transparent 50%),
                    radial-gradient(circle at 20% 80%, rgba(16,185,129,0.08) 0%, transparent 50%);
        pointer-events: none;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 3rem;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(14, 165, 233, 0.1);
        border: 1px solid rgba(14, 165, 233, 0.3);
        border-radius: 50px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 600;
        color: #7dd3fc;
        letter-spacing: 0.5px;
        margin-bottom: 1.5rem;
        width: fit-content;
    }

    .hero h1 {
        font-size: clamp(28px, 4vw, 42px);
        line-height: 1.2;
        color: var(--text-on-dark);
        margin-bottom: 1.5rem;
    }

    .hero h1 span { color: var(--sky); }

    .hero p {
        font-size: 16px;
        color: var(--text-muted);
        line-height: 1.8;
        margin-bottom: 2rem;
        max-width: 500px;
    }

    .btn-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 2.5rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        border: none;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--sky) 0%, #0284c7 100%);
        color: white;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(14, 165, 233, 0.4);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-on-dark);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .stats {
        display: flex;
        gap: 1.5rem;
    }

    .stat {
        display: flex;
        flex-direction: column;
    }

    .stat-value {
        font-size: clamp(20px, 3vw, 28px);
        font-weight: 700;
        color: var(--sky);
    }

    .stat-label {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* Featured Box */
    .featured {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2rem;
        backdrop-filter: blur(10px);
    }

    .featured-title {
        font-size: 12px;
        font-weight: 600;
        color: #fbbf24;
        margin-bottom: 1.5rem;
        letter-spacing: 0.5px;
    }

    .featured-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1.25rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .featured-item:last-child { border-bottom: none; }

    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex-shrink: 0;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
    }

    .featured-item p:first-child {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-on-dark);
    }

    .featured-item span {
        font-size: 12px;
        color: var(--text-muted);
    }

    .promo {
        margin-top: 1.5rem;
        padding: 12px;
        background: linear-gradient(135deg, rgba(14,165,233,0.1) 0%, rgba(14,165,233,0.05) 100%);
        border: 1px solid rgba(14,165,233,0.2);
        border-radius: 12px;
        font-size: 11px;
        color: #7dd3fc;
        text-align: center;
        font-weight: 500;
    }

    /* ── CATALOG SECTION ── */
    .catalog { margin-top: 4rem; }

    .section-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .section-head h2 {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
    }

    .eyebrow {
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .section-desc {
        font-size: 14px;
        color: #64748b;
        line-height: 1.6;
    }

    /* Toolbar */
    .toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        flex: 1;
        min-width: 220px;
    }

    .search-box svg {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        color: #94a3b8;
        pointer-events: none;
    }

    .search-box input {
        width: 100%;
        padding: 12px 14px 12px 40px;
        border: 1.5px solid var(--border-light);
        border-radius: 12px;
        background: white;
        font-size: 14px;
        transition: all 0.3s;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--sky);
        box-shadow: 0 0 0 4px rgba(14,165,233,0.1);
    }

    .search-clear {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        font-size: 16px;
        padding: 4px;
        display: none;
        transition: color 0.2s;
    }

    .search-clear:hover {
        color: #0f172a;
    }

    .search-box input:not(:placeholder-shown) ~ .search-clear {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tabs {
        display: flex;
        gap: 8px;
    }

    .tab {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
        background: white;
        border: 1.5px solid var(--border-light);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        cursor: pointer;
        transition: all 0.3s;
    }

    .tab.active {
        background: #0f172a;
        color: white;
        border-color: #0f172a;
    }

    .tab-count {
        font-size: 11px;
        background: rgba(0,0,0,0.05);
        padding: 2px 6px;
        border-radius: 4px;
    }

    .tab.active .tab-count {
        background: rgba(255,255,255,0.2);
    }

    select {
        padding: 10px 14px;
        border: 1.5px solid var(--border-light);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
    }

    select:focus {
        outline: none;
        border-color: var(--sky);
        box-shadow: 0 0 0 4px rgba(14,165,233,0.1);
    }

    /* Counter */
    .counter {
        font-size: 13px;
        color: #94a3b8;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    /* Grid & Cards */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    .card {
        background: white;
        border: 1px solid var(--border-light);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
    }

    .card:hover {
        border-color: var(--sky);
        box-shadow: 0 12px 40px rgba(14, 165, 233, 0.15);
        transform: translateY(-6px);
    }

    .card-img {
        position: relative;
        background: linear-gradient(135deg, #f0f9ff 0%, #f0fdfa 100%);
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 64px;
    }

    .card-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--sky);
        color: white;
        font-size: 10px;
        font-weight: 700;
        padding: 6px 10px;
        border-radius: 8px;
        text-transform: uppercase;
    }

    .card-badge.emerald {
        background: var(--emerald);
    }

    .card-heart {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 36px;
        height: 36px;
        background: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .card-heart:hover {
        background: var(--sky);
        color: white;
        transform: scale(1.1);
    }

    .card-heart svg {
        width: 18px;
        height: 18px;
    }

    .card-info {
        padding: 1.25rem;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .card-price {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
    }

    .card-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        color: #94a3b8;
    }

    .star {
        width: 14px;
        height: 14px;
        fill: #fbbf24;
    }

    .card-title {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .card-desc {
        font-size: 12px;
        color: #94a3b8;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .stock {
        font-size: 11px;
        font-weight: 600;
        color: #10b981;
    }

    .card-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 12px;
        background: linear-gradient(135deg, var(--sky) 0%, #0284c7 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .card-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .card-btn svg {
        width: 14px;
        height: 14px;
    }

    .empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        color: #94a3b8;
    }

    .empty svg {
        width: 64px;
        height: 64px;
        margin: 0 auto 1rem;
        opacity: 0.5;
    }

    /* ── WHY SECTION ── */
    .why {
        margin-top: 4rem;
        padding: 3rem;
        background: linear-gradient(135deg, #f0f9ff 0%, #f0fdfa 100%);
        border-radius: 24px;
    }

    .why-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: start;
    }

    .why h2 {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1rem;
    }

    .why p {
        font-size: 15px;
        color: #64748b;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .why-cards {
        display: grid;
        gap: 1rem;
    }

    .why-card {
        background: white;
        padding: 1.25rem;
        border-radius: 12px;
        border-left: 3px solid var(--sky);
    }

    .why-card-label {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .why-card-text {
        font-size: 13px;
        color: #64748b;
        line-height: 1.6;
    }

    .checklist {
        display: grid;
        gap: 1.25rem;
    }

    .check {
        display: flex;
        gap: 1rem;
    }

    .check-num {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--sky) 0%, #0284c7 100%);
        color: white;
        border-radius: 8px;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    .check-title {
        font-size: 13px;
        font-weight: 600;
        color: #0f172a;
    }

    .check-sub {
        font-size: 12px;
        color: #64748b;
        margin-top: 4px;
        line-height: 1.5;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .hero-grid { grid-template-columns: 1fr; }
        .section-head { flex-direction: column; align-items: flex-start; }
        .section-desc { text-align: left; }
        .why-grid { grid-template-columns: 1fr; }
        .toolbar { flex-direction: column; align-items: stretch; }
        .tabs { flex-wrap: wrap; }
    }

    @media (max-width: 600px) {
        .hero { padding: 1.5rem; }
        .hero-grid { gap: 2rem; }
        .hero h1 { font-size: 24px; }
        .btn { font-size: 13px; padding: 10px 20px; }
        .hero p { font-size: 14px; }
        .stats { gap: 1rem; }
        .featured { padding: 1.5rem; }
        .grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem; }
        .section-head h2 { font-size: 20px; }
        .why { padding: 1.5rem; }
        .toolbar { gap: 8px; }
        .tab { padding: 8px 12px; font-size: 12px; }
    }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .card { animation: fadeUp 0.3s ease both; }

    /* ── SHOPPING CART ── */
    .cart-badge {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--sky) 0%, #0284c7 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.4);
        z-index: 40;
        transition: all 0.3s;
        color: white;
        font-weight: 700;
        font-size: 20px;
    }

    .cart-badge:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 28px rgba(14, 165, 233, 0.5);
    }

    .cart-count {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .cart-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 50;
        padding: 1rem;
    }

    .cart-modal.active {
        display: flex;
    }

    .cart-panel {
        background: white;
        border-radius: 20px;
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .cart-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .cart-header h2 {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
    }

    .cart-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #94a3b8;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
    }

    .cart-close:hover {
        color: #0f172a;
    }

    .cart-items {
        padding: 1rem;
        min-height: 200px;
    }

    .cart-item {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 1rem;
        align-items: flex-start;
    }

    .cart-item-icon {
        font-size: 32px;
        flex-shrink: 0;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-name {
        font-size: 13px;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .cart-item-price {
        font-size: 12px;
        color: #94a3b8;
        margin-bottom: 8px;
    }

    .cart-item-qty {
        display: flex;
        align-items: center;
        gap: 8px;
        width: fit-content;
    }

    .qty-btn {
        background: white;
        border: 1px solid var(--border-light);
        width: 24px;
        height: 24px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .qty-btn:hover {
        border-color: var(--sky);
        color: var(--sky);
    }

    .qty-input {
        width: 32px;
        text-align: center;
        border: none;
        background: none;
        font-size: 12px;
        font-weight: 600;
        color: #0f172a;
    }

    .cart-item-remove {
        background: none;
        border: none;
        color: #ef4444;
        cursor: pointer;
        font-size: 16px;
        padding: 0;
        transition: color 0.2s;
    }

    .cart-item-remove:hover {
        color: #dc2626;
    }

    .cart-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: #94a3b8;
    }

    .cart-footer {
        border-top: 1px solid var(--border-light);
        padding: 1.5rem;
    }

    .cart-total {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-light);
    }

    .cart-total-label {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
    }

    .cart-total-value {
        font-size: 16px;
        font-weight: 700;
        color: var(--sky);
    }

    .cart-checkout {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, var(--sky) 0%, #0284c7 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
    }

    .cart-checkout:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .cart-checkout:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    @media (max-width: 600px) {
        .cart-badge {
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 18px;
        }
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-grid">
            <div>
                <div class="badge">✨ Outdoor Gear • Hiking Essentials</div>
                <h1>Perlengkapan Hiking Premium untuk <span>Petualangan</span> Tak Terlupakan</h1>
                <p>Koleksi perlengkapan hiking dan pakaian outdoor terbaik—desain modern, fungsi premium, dan kenyamanan maksimal untuk setiap jalur dan ketinggian.</p>
                <div class="btn-group">
                    <a href="#katalog" class="btn btn-primary">🔍 Lihat Katalog</a>
                    <a href="#kenapa" class="btn btn-secondary">Kenapa Kami? ↗</a>
                </div>
                <div class="stats">
                    <div class="stat">
                        <div class="stat-value">500+</div>
                        <div class="stat-label">Produk</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">4.9★</div>
                        <div class="stat-label">Rating</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">10K+</div>
                        <div class="stat-label">Puas</div>
                    </div>
                </div>
            </div>

            <div class="featured">
                <div class="featured-title">🔥 Trending Minggu Ini</div>
                <div class="featured-item">
                    <div class="dot" style="background:#0ea5e9"></div>
                    <div>
                        <p>Ransel 45L TrailPro</p>
                        <span>Tahan air, bantalan ergonomis</span>
                    </div>
                </div>
                <div class="featured-item">
                    <div class="dot" style="background:#10b981"></div>
                    <div>
                        <p>Jaket Softshell WindTech</p>
                        <span>Windproof, 4-way stretch</span>
                    </div>
                </div>
                <div class="featured-item">
                    <div class="dot" style="background:#a78bfa"></div>
                    <div>
                        <p>Tenda Solo Alpine</p>
                        <span>Ultralight 1.4kg, all-season</span>
                    </div>
                </div>
                <div class="promo">🚚 Gratis ongkir Rp 500K+ hari ini</div>
            </div>
        </div>
    </section>

    {{-- CATALOG --}}
    <section id="katalog" class="catalog">
        <div class="section-head">
            <div>
                <div class="eyebrow">Katalog Lengkap</div>
                <h2>Perlengkapan Outdoor Siap Pakai</h2>
            </div>
            <p class="section-desc">Pilih sesuai kebutuhan dari pendakian sehari hingga ekspedisi multi-hari.</p>
        </div>

        <div class="toolbar">
            <div class="search-box">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input type="text" id="search" placeholder="Cari produk..." oninput="filter()">
                <button class="search-clear" type="button" onclick="clearSearch()">✕</button>
            </div>
            <div class="tabs">
                <button class="tab active" onclick="cat(this, 'all')">Semua <span class="tab-count" id="cnt-all">-</span></button>
                <button class="tab" onclick="cat(this, 'hiking')">🥾 Alat <span class="tab-count" id="cnt-hiking">-</span></button>
                <button class="tab" onclick="cat(this, 'pakaian')">👕 Pakaian <span class="tab-count" id="cnt-pakaian">-</span></button>
            </div>
            <select id="sort" onchange="filter()">
                <option value="default">Default</option>
                <option value="price-low">Harga ↓</option>
                <option value="price-high">Harga ↑</option>
                <option value="name">Nama A–Z</option>
            </select>
        </div>

        <div id="counter" class="counter"></div>

        <div class="grid" id="grid">
            @forelse($products as $product)
                <div class="card" data-cat="{{ $product->category ?? 'hiking' }}" data-price="{{ $product->price }}" data-name="{{ strtolower($product->name) }}" data-search="{{ strtolower($product->name . ' ' . ($product->description ?? '')) }}">
                    <div class="card-img">
                        @if(($product->category ?? 'hiking') === 'pakaian')
                            👕
                            <span class="card-badge emerald">Pakaian</span>
                        @else
                            🎒
                            <span class="card-badge">Alat</span>
                        @endif
                        <button class="card-heart" onclick="toggleWish(this)">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        </button>
                    </div>
                    <div class="card-info">
                        <div class="card-header">
                            <span class="card-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="card-rating">
                                <svg class="star" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                {{ $product->rating ?? '4.8' }}
                            </span>
                        </div>
                        <h3 class="card-title">{{ $product->name }}</h3>
                        <p class="card-desc">{{ $product->description ?? 'Perlengkapan outdoor premium' }}</p>
                        <div class="card-footer">
                            <span class="stock">Stok {{ $product->stock ?? 0 }}</span>
                            <button class="card-btn" onclick="addToCart(this, '{{ $product->name }}', {{ $product->price }})">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/></svg>
                    <p style="font-weight:600;margin-bottom:4px">Belum ada produk</p>
                    <p style="font-size:12px">Cek kembali nanti</p>
                </div>
            @endforelse
        </div>

        <!-- Cart Modal -->
        <div id="cartModal" class="cart-modal" onclick="if(event.target === this) closeCart()">
            <div class="cart-panel">
                <div class="cart-header">
                    <h2>🛒 Keranjang Belanja</h2>
                    <button class="cart-close" onclick="closeCart()">✕</button>
                </div>
                <div class="cart-items" id="cartItems"></div>
                <div class="cart-footer" id="cartFooter"></div>
            </div>
        </div>

        <!-- Cart Badge -->
        <div class="cart-badge" onclick="openCart()">
            <span id="cartCountBadge">0</span>
            <div class="cart-count" id="cartCount" style="display: none;">0</div>
        </div>
    </section>

    {{-- WHY US --}}
    <section id="kenapa" class="why">
        <div class="why-grid">
            <div>
                <div class="eyebrow">Kenapa Kami?</div>
                <h2>Gear Hiking Premium dengan Tampilan Modern</h2>
                <p>Semua produk dipilih khusus untuk kenyamanan, ketahanan, dan kepraktisan di jalur. Dari ransel dan tenda hingga jaket teknis, semuanya dirancang menemani perjalanan Anda dengan percaya diri.</p>
                <div class="why-cards">
                    <div class="why-card">
                        <div class="why-card-label">Performa Terpercaya</div>
                        <div class="why-card-text">Bahan kuat, fitur fungsional, detail yang mendukung mobilitas penuh di lapangan.</div>
                    </div>
                    <div class="why-card">
                        <div class="why-card-label">Desain Modern</div>
                        <div class="why-card-text">Estetika premium dengan tampilan segar untuk alam bebas maupun urban.</div>
                    </div>
                </div>
            </div>
            <div class="checklist">
                <div class="check">
                    <div class="check-num">1</div>
                    <div>
                        <p class="check-title">Ransel & Tas</p>
                        <p class="check-sub">Kapasitas cukup, kompartemen terorganisir, mudah dibawa.</p>
                    </div>
                </div>
                <div class="check">
                    <div class="check-num">2</div>
                    <div>
                        <p class="check-title">Tenda & Sleeping</p>
                        <p class="check-sub">Ringan, hangat, tahan cuaca ekstrim.</p>
                    </div>
                </div>
                <div class="check">
                    <div class="check-num">3</div>
                    <div>
                        <p class="check-title">Pakaian Teknis</p>
                        <p class="check-sub">Moisture-wicking, windproof, nyaman sepanjang hari.</p>
                    </div>
                </div>
                <div class="check">
                    <div class="check-num">4</div>
                    <div>
                        <p class="check-title">Aksesori Safety</p>
                        <p class="check-sub">Headlamp, botol air, perlindungan elemen alam.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    let currentCat = 'all';
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // ── SEARCH & FILTER ──
    function clearSearch() {
        document.getElementById('search').value = '';
        filter();
    }

    function cat(btn, category) {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');
        currentCat = category;
        filter();
    }

    function filter() {
        const search = document.getElementById('search').value.toLowerCase();
        const sort = document.getElementById('sort').value;
        let cards = Array.from(document.querySelectorAll('.card'));

        cards = cards.filter(card => {
            const matchCat = currentCat === 'all' || card.dataset.cat === currentCat;
            const matchSearch = card.dataset.search.includes(search);
            return matchCat && matchSearch;
        });

        cards.sort((a, b) => {
            if (sort === 'price-low') return parseInt(b.dataset.price) - parseInt(a.dataset.price);
            if (sort === 'price-high') return parseInt(a.dataset.price) - parseInt(b.dataset.price);
            if (sort === 'name') return a.dataset.name.localeCompare(b.dataset.name);
            return 0;
        });

        const grid = document.getElementById('grid');
        grid.innerHTML = '';
        cards.forEach(card => grid.appendChild(card));

        const count = cards.length;
        document.getElementById('counter').textContent = count ? `${count} produk ditemukan` : 'Tidak ada produk';

        const total = document.querySelectorAll('.card').length;
        document.getElementById('cnt-all').textContent = total;
        document.getElementById('cnt-hiking').textContent = document.querySelectorAll('[data-cat="hiking"]').length;
        document.getElementById('cnt-pakaian').textContent = document.querySelectorAll('[data-cat="pakaian"]').length;
    }

    function toggleWish(btn) {
        btn.classList.toggle('active');
        btn.style.background = btn.classList.contains('active') ? '#fbbf24' : 'white';
        btn.style.color = btn.classList.contains('active') ? 'white' : 'currentColor';
    }

    // ── SHOPPING CART ──
    function addToCart(btn, name, price) {
        const existing = cart.find(item => item.name === name);
        
        if (existing) {
            existing.qty++;
        } else {
            cart.push({ name, price, qty: 1 });
        }
        
        saveCart();
        updateCartUI();
        
        btn.textContent = '✓ Ditambah';
        btn.style.background = '#10b981';
        setTimeout(() => {
            btn.textContent = '🛒 Tambah';
            btn.style.background = '';
        }, 1500);
    }

    function removeFromCart(name) {
        cart = cart.filter(item => item.name !== name);
        saveCart();
        updateCartUI();
    }

    function updateQty(name, change) {
        const item = cart.find(i => i.name === name);
        if (item) {
            item.qty += change;
            if (item.qty <= 0) {
                removeFromCart(name);
            } else {
                saveCart();
                updateCartUI();
            }
        }
    }

    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function updateCartUI() {
        const total = cart.reduce((sum, item) => sum + item.qty, 0);
        document.getElementById('cartCountBadge').textContent = total;
        
        if (total > 0) {
            document.getElementById('cartCount').style.display = 'flex';
            document.getElementById('cartCount').textContent = total;
        } else {
            document.getElementById('cartCount').style.display = 'none';
        }

        const cartItems = document.getElementById('cartItems');
        const cartFooter = document.getElementById('cartFooter');

        if (cart.length === 0) {
            cartItems.innerHTML = '<div class="cart-empty"><p>Keranjang Anda kosong</p><p style="font-size:12px;margin-top:8px">Mulai tambahkan produk favorit Anda</p></div>';
            cartFooter.innerHTML = '';
        } else {
            const icons = { 'Jaket': '👕', 'Celana': '👕', 'Kaos': '👕', 'Topi': '👕', 'Sarung': '👕', 'Socks': '👕', 'Ransel': '🎒', 'Tenda': '⛺', 'Matras': '🏕️', 'Headlamp': '🔦', 'Water': '💧', 'Sleeping': '🛏️' };
            
            cartItems.innerHTML = cart.map(item => {
                const icon = Object.keys(icons).find(k => item.name.includes(k)) ? icons[Object.keys(icons).find(k => item.name.includes(k))] : '📦';
                const subtotal = item.price * item.qty;
                return `
                    <div class="cart-item">
                        <div class="cart-item-icon">${icon}</div>
                        <div class="cart-item-info">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-price">Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</div>
                            <div class="cart-item-qty">
                                <button class="qty-btn" onclick="updateQty('${item.name}', -1)">−</button>
                                <input type="number" class="qty-input" value="${item.qty}" readonly>
                                <button class="qty-btn" onclick="updateQty('${item.name}', 1)">+</button>
                            </div>
                        </div>
                        <button class="cart-item-remove" onclick="removeFromCart('${item.name}')">🗑️</button>
                    </div>
                `;
            }).join('');

            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            cartFooter.innerHTML = `
                <div class="cart-total">
                    <span class="cart-total-label">Total Harga:</span>
                    <span class="cart-total-value">Rp ${new Intl.NumberFormat('id-ID').format(totalPrice)}</span>
                </div>
                <button class="cart-checkout" onclick="checkout()">
                    ✓ Lanjut ke Checkout
                </button>
            `;
        }
    }

    function openCart() {
        document.getElementById('cartModal').classList.add('active');
    }

    function closeCart() {
        document.getElementById('cartModal').classList.remove('active');
    }

    function checkout() {
        if (cart.length === 0) {
            alert('Keranjang Anda kosong');
            return;
        }
        alert('Fitur checkout sedang dikembangkan.\n\nTotal barang: ' + cart.reduce((sum, item) => sum + item.qty, 0) + '\nTotal harga: Rp ' + new Intl.NumberFormat('id-ID').format(cart.reduce((sum, item) => sum + (item.price * item.qty), 0)));
    }

    // Initialize
    filter();
    updateCartUI();
</script>
@endpush
