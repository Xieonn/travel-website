@extends('layouts.app')

@section('title', 'Masuk ke Akun Anda')

@push('styles')
<style>
    /* ── AUTHENTICATION LAYOUT ───────────────────────────────── */
    .auth-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 65vh;
        padding: 2rem 0;
    }

    .auth-card {
        background: #ffffff;
        width: 100%;
        max-width: 440px;
        border-radius: 16px;
        padding: 3rem 2.5rem;
        box-shadow: 0 10px 40px rgba(13, 59, 94, 0.06);
        border: 1px solid rgba(13, 59, 94, 0.05);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.25rem;
        color: var(--brand-ocean);
        margin: 0 0 0.5rem 0;
        letter-spacing: -0.02em;
    }

    .auth-header p {
        color: #4A5568;
        font-size: 0.95rem;
        margin: 0;
    }

    /* ── FORM ELEMENTS ───────────────────────────────────────── */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--brand-ink);
        margin-bottom: 0.4rem;
    }

    .form-input {
        width: 100%;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        padding: 0.75rem 1rem;
        color: var(--brand-ink);
        background: var(--brand-mist);
        border: 1px solid rgba(13, 59, 94, 0.12);
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--brand-sky);
        background: white;
        box-shadow: 0 0 0 3px rgba(26, 111, 168, 0.1);
    }

    .form-text-error {
        color: var(--brand-coral);
        font-size: 0.8rem;
        margin-top: 0.4rem;
        display: block;
    }

    /* ── AUTH ACTIONS (Remember Me & Forgot Password) ────────── */
    .auth-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
        margin-bottom: 2rem;
        font-size: 0.875rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #4A5568;
        cursor: pointer;
    }

    .remember-me input[type="checkbox"] {
        accent-color: var(--brand-ocean);
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    .forgot-password-link {
        color: var(--brand-sky);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .forgot-password-link:hover {
        color: var(--brand-ocean);
        text-decoration: underline;
    }

    /* ── BUTTONS ─────────────────────────────────────────────── */
    .btn-submit {
        width: 100%;
        font-family: 'DM Sans', sans-serif;
        font-size: 1rem;
        font-weight: 500;
        color: white;
        background: var(--brand-ocean);
        border: none;
        padding: 0.85rem;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-submit:hover {
        background: var(--brand-sky);
        transform: translateY(-1px);
    }

    .auth-footer {
        text-align: center;
        margin-top: 2rem;
        font-size: 0.9rem;
        color: #4A5568;
    }

    .auth-footer a {
        color: var(--brand-ocean);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }

    .auth-footer a:hover {
        color: var(--brand-sky);
        text-decoration: underline;
    }

    /* Session Status Message (Breeze default) */
    .status-message {
        background: rgba(16,185,129,0.08);
        border: 1px solid rgba(16,185,129,0.25);
        color: #065F46;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        
        <div class="auth-header">
            <h1>Selamat Datang</h1>
            <p>Silakan masuk untuk melanjutkan perjalanan Anda.</p>
        </div>

        {{-- Session Status (misal: sukses reset password) --}}
        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        {{-- Form Login Utama --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email Address --}}
            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com">
                @error('email')
                    <span class="form-text-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-input" required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <span class="form-text-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="auth-options">
                <label for="remember_me" class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-password-link" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn-submit">
                Masuk ke Akun
            </button>
        </form>

        {{-- Link ke Register --}}
        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang gratis</a>
        </div>

    </div>
</div>
@endsection