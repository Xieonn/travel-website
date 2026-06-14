{{-- File: resources/views/admin/users/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Ubah Data Pengguna')

@push('styles')
<style>
    .page-header { margin-bottom: 2rem; }
    
    .page-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        color: var(--brand-ocean);
        margin: 0;
        letter-spacing: -0.02em;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13,59,94,0.04);
        border: 1px solid rgba(13,59,94,0.05);
        padding: 2.5rem;
        max-width: 800px;
    }

    .form-group { margin-bottom: 1.5rem; }

    .form-label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--brand-ink);
        font-size: 0.95rem;
    }

    .form-label span.required { color: var(--brand-coral); }
    .form-label span.optional { color: #718096; font-size: 0.8rem; font-weight: normal; margin-left: 4px; }

    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid rgba(13,59,94,0.15);
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.95rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--brand-sky);
        box-shadow: 0 0 0 3px rgba(26,111,168,0.1);
    }

    .form-error {
        color: var(--brand-coral);
        font-size: 0.85rem;
        margin-top: 0.4rem;
        display: block;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2.5rem;
        align-items: center;
    }

    .btn-submit {
        background: var(--brand-ocean);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        font-family: inherit;
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
    }

    .btn-submit:hover { background: var(--brand-sky); transform: translateY(-1px); }

    .btn-cancel {
        color: #4A5568;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        padding: 0.8rem 1rem;
        transition: color 0.2s;
    }

    .btn-cancel:hover { color: var(--brand-coral); }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1 class="page-title">Ubah Data Pengguna</h1>
    </div>

    <div class="form-card">
        {{-- Aksi mengarah ke route update dan membutuhkan parameter ID user --}}
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            {{-- Form HTML standar tidak mendukung PUT, jadi kita gunakan directive ini --}}
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                {{-- old('name', $user->name) berarti: gunakan data inputan lama jika ada error, jika tidak ada tampilkan data dari database --}}
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Alamat Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi Baru <span class="optional">(Biarkan kosong jika tidak ingin mengubah sandi)</span></label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                @error('password') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ketik ulang kata sandi baru">
            </div>

            <div class="form-group">
                <label for="roles" class="form-label">Peran (Role) <span class="required">*</span></label>
                <select name="roles[]" id="roles" class="form-control" required>
                    @foreach($roles as $role)
                        {{-- Logika in_array digunakan untuk menandai peran yang sedang aktif dengan atribut 'selected' --}}
                        <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>
                @error('roles') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Perbarui Data</button>
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
@endsection