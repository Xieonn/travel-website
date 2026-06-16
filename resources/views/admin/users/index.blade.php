@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@push('styles')
<style>
    /* ── HEADER HALAMAN ───────────────────────────────────── */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        color: var(--brand-ocean);
        margin: 0;
        letter-spacing: -0.02em;
    }

    .btn-primary {
        background: var(--brand-ocean);
        color: white;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: background 0.2s, transform 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary:hover {
        background: var(--brand-sky);
        transform: translateY(-1px);
    }

    /* ── KARTU & TABEL ────────────────────────────────────── */
    .data-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13,59,94,0.04);
        overflow: hidden;
        border: 1px solid rgba(13,59,94,0.05);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .data-table th {
        background: rgba(13,59,94,0.02);
        color: var(--brand-ocean);
        font-weight: 600;
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid rgba(13,59,94,0.08);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .data-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(13,59,94,0.04);
        color: #4A5568;
        font-size: 0.95rem;
        vertical-align: middle;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        background: rgba(13,59,94,0.01);
    }

    /* ── BADGE ROLE (Spatie) ──────────────────────────────── */
    .role-badge {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
        margin-right: 4px;
        margin-bottom: 4px;
    }

    .role-admin {
        background: rgba(217,101,74,0.1);
        color: var(--brand-coral);
        border: 1px solid rgba(217,101,74,0.2);
    }

    .role-seller {
        background: rgba(26,122,74,0.1);
        color: #1A7A4A;
        border: 1px solid rgba(26,122,74,0.2);
    }

    .role-user {
        background: rgba(13,59,94,0.06);
        color: var(--brand-ocean);
        border: 1px solid rgba(13,59,94,0.15);
    }

    /* ── TOMBOL AKSI ──────────────────────────────────────── */
    .action-group {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .action-edit {
        color: var(--brand-sky);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        transition: color 0.2s;
    }

    .action-edit:hover {
        color: var(--brand-ocean);
        text-decoration: underline;
    }

    .action-delete {
        background: none;
        border: none;
        color: var(--brand-coral);
        font-weight: 500;
        font-size: 0.875rem;
        cursor: pointer;
        padding: 0;
        font-family: inherit;
        transition: color 0.2s;
    }

    .action-delete:hover {
        color: #B9452A;
        text-decoration: underline;
    }

    /* ── PAGINASI ─────────────────────────────────────────── */
    .pagination-container {
        padding: 1.5rem;
        border-top: 1px solid rgba(13,59,94,0.05);
        background: white;
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1 class="page-title">Kelola Pengguna</h1>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Pengguna
        </a>
    </div>

    <div class="data-card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Informasi Pengguna</th>
                        <th>Peran (Role)</th>
                        <th>Tanggal Terdaftar</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div style="font-weight: 500; color: var(--brand-ink);">{{ $user->name }}</div>
                                <div style="font-size: 0.85rem; color: #718096; margin-top: 2px;">{{ $user->email }}</div>
                            </td>
                            <td>
                                {{-- Menampilkan label peran menggunakan data dari Spatie Permission --}}
                                @forelse($user->roles as $role)
                                    @php
                                        // Menentukan kelas CSS berdasarkan nama peran
                                        $badgeClass = 'role-user';
                                        if($role->name == 'admin') $badgeClass = 'role-admin';
                                        if($role->name == 'seller') $badgeClass = 'role-seller';
                                    @endphp
                                    <span class="role-badge {{ $badgeClass }}">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="role-badge role-user">Tidak ada</span>
                                @endforelse
                            </td>
                            <td>
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="action-edit">Ubah</a>
                                    
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 3rem 1.5rem; color: #718096;">
                                Belum ada data pengguna yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Navigasi Paginasi bawaan Laravel --}}
        @if($users->hasPages())
            <div class="pagination-container">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection