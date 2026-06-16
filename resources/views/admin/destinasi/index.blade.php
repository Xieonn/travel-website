@extends('layouts.app')

@section('title', 'Kelola Destinasi')

@push('styles')
<style>
    .header-title {
        font-family: 'Cormorant Garamond', serif;
        color: var(--brand-ocean);
    }
    
    .btn-brand {
        background-color: var(--brand-ocean);
        color: white;
        transition: background-color 0.2s, transform 0.15s;
    }
    
    .btn-brand:hover {
        background-color: var(--brand-sky);
        transform: translateY(-1px);
    }

    .table-head-brand {
        background-color: rgba(13, 59, 94, 0.03);
        color: var(--brand-ink);
    }

    .text-brand-sky {
        color: var(--brand-sky);
    }

    .text-brand-sky:hover {
        color: var(--brand-ocean);
    }
</style>
@endpush

@section('content')
    {{-- Tombol Kembali --}}
    <a href="/dashboard" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-800 font-medium text-sm mb-6 transition group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Dashboard
    </a>

    {{-- Header Section --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-bold header-title mb-1">Kelola Destinasi</h1>
            <p class="text-gray-500 text-sm">Pusat pengaturan daftar tempat wisata dan lokasi destinasi</p>
        </div>
        {{-- Tombol Tambah Destinasi --}}
        <a href="/admin/destinasi/create" class="btn-brand rounded-xl px-5 py-2.5 text-sm font-semibold shadow-sm flex items-center gap-2 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Destinasi Baru
        </a>
    </div>

    {{-- Container Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="table-head-brand border-b border-gray-100 text-sm font-semibold">
                        <th class="px-6 py-4 w-20">No</th>
                        <th class="px-6 py-4 w-32">Foto</th>
                        <th class="px-6 py-4">Nama Destinasi</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($destinations as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            {{-- Penomoran --}}
                            <td class="px-6 py-4 font-medium text-gray-500 text-sm">
                                {{ $destinations->firstItem() + $index }}
                            </td>
                            
                            {{-- Preview Gambar Destinasi --}}
                            <td class="px-6 py-4">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Foto {{ $item->name }}" class="w-20 h-14 object-cover rounded-lg border border-gray-100 shadow-sm">
                                @else
                                    <div class="w-20 h-14 bg-blue-50 rounded-lg flex items-center justify-center text-xl border border-dashed border-blue-100 text-gray-400">🏝️</div>
                                @endif
                            </td>
                            
                            {{-- Nama Destinasi --}}
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 block text-base">{{ $item->name }}</span>
                            </td>
                            
                            {{-- Lokasi Destinasi --}}
                            <td class="px-6 py-4 text-sm text-gray-500">
                                📍 {{ $item->location }}
                            </td>
                            
                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="/admin/destinasi/{{ $item->id }}/edit" class="text-sm font-medium text-brand-sky hover:underline">
                                        Edit
                                    </a>
                                    <span class="text-gray-200">|</span>
                                    <form action="/admin/destinasi/{{ $item->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 hover:underline cursor-pointer bg-transparent border-none p-0 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 text-3xl mb-4 border border-gray-100">🏝️</div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Belum ada destinasi</h3>
                                <p class="text-sm text-gray-500">Mulai tambahkan tempat wisata pertama Anda ke dalam sistem.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        @if($destinations->hasPages())
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                {{ $destinations->links() }}
            </div>
        @endif
    </div>
@endsection