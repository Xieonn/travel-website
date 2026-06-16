@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@push('styles')
<style>
    .form-container { max-width: 700px; margin: 0 auto; padding-top: 1rem; }
    .card { background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 4px 24px rgba(13, 59, 94, 0.04); border: 1px solid rgba(13, 59, 94, 0.06); }
    .card-header { font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: var(--brand-ocean); margin: 0 0 1.5rem 0; border-bottom: 1px solid rgba(13, 59, 94, 0.08); padding-bottom: 1rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: var(--brand-ink); margin-bottom: 0.5rem; }
    .form-input { width: 100%; font-family: 'DM Sans', sans-serif; font-size: 0.95rem; padding: 0.75rem 1rem; color: var(--brand-ink); background: var(--brand-mist); border: 1px solid rgba(13, 59, 94, 0.15); border-radius: 8px; transition: all 0.2s; }
    .form-input:focus { outline: none; border-color: var(--brand-sky); background: white; box-shadow: 0 0 0 3px rgba(26, 111, 168, 0.1); }
    .form-error { color: var(--brand-coral); font-size: 0.8rem; margin-top: 0.4rem; display: block; }
    .btn-submit { display: inline-flex; justify-content: center; width: 100%; font-family: 'DM Sans', sans-serif; font-size: 1rem; font-weight: 500; color: white; background: var(--brand-ocean); border: none; padding: 0.85rem; border-radius: 8px; cursor: pointer; transition: background 0.2s; margin-top: 1rem; }
    .btn-submit:hover { background: var(--brand-sky); }
    .back-link { display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #4A5568; font-size: 0.95rem; font-weight: 500; margin-bottom: 1.5rem; }
    .back-link:hover { color: var(--brand-ocean); }
    .divider { height: 1px; background: rgba(13, 59, 94, 0.08); margin: 2rem 0; }
</style>
@endpush

@section('content')
<div class="form-container">
    <a href="{{ route('dashboard') }}" class="back-link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Kembali ke Dashboard
    </a>

    <div class="card">
        <h1 class="card-header">Pengaturan Akun</h1>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- Informasi Dasar --}}
            <h3 style="font-size: 1.1rem; color: var(--brand-ocean); margin-bottom: 1rem;">Informasi Profil</h3>
            
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $user->name ?? auth()->user()->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email ?? auth()->user()->email) }}" required>
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="divider"></div>

            {{-- Ubah Password --}}
            <h3 style="font-size: 1.1rem; color: var(--brand-ocean); margin-bottom: 0.5rem;">Ubah Kata Sandi</h3>
            <p style="font-size: 0.85rem; color: #718096; margin-top: 0; margin-bottom: 1.5rem;">Biarkan kosong jika Anda tidak ingin mengubah kata sandi saat ini.</p>

            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi Baru</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Minimal 8 karakter">
                @error('password') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi baru">
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection