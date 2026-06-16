@extends('layouts.app')

@section('title', 'Kelola Berita')

{{-- Menambahkan CSS khusus yang memanggil variabel dari app.blade.php --}}
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
        background-color: rgba(13, 59, 94, 0.03); /* Transparansi dari --brand-ocean */
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
            <h1 class="text-4xl font-bold header-title mb-1">Kelola Berita</h1>
            <p class="text-gray-500 text-sm">Pusat pengaturan konten artikel dan berita perjalanan</p>
        </div>
        {{-- Tombol Tambah Berita --}}
        <a href="/admin/berita/create" class="btn-brand rounded-xl px-5 py-2.5 text-sm font-semibold shadow-sm flex items-center gap-2 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Berita Baru
        </a>
    </div>

    {{-- Container Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="table-head-brand border-b border-gray-100 text-sm font-semibold">
                        <th class="px-6 py-4 w-20">No</th>
                        <th class="px-6 py-4 w-32">Thumbnail</th>
                        <th class="px-6 py-4">Judul Berita</th>
                        <th class="px-6 py-4">Tanggal Rilis</th>
                        <th class="px-6 py-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($posts as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            {{-- Penomoran --}}
                            <td class="px-6 py-4 font-medium text-gray-500 text-sm">
                                {{ $posts->firstItem() + $index }}
                            </td>
                            
                            {{-- Thumbnail --}}
                            <td class="px-6 py-4">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Image" class="w-20 h-14 object-cover rounded-md">
                                @else
                                    {{-- Ikon bawaan jika berita tidak memiliki gambar --}}
                                    <div class="w-20 h-14 bg-gray-50 rounded-lg flex items-center justify-center text-xl border border-dashed border-gray-200 text-gray-400">
                                        📰
                                    </div>
                                @endif
                            </td>
                            
                            {{-- Konten Teks --}}
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 block line-clamp-1 text-base">{{ $item->title }}</span>
                                <span class="text-xs text-gray-400 block mt-1 line-clamp-1">{{ Str::limit(strip_tags($item->content), 80) }}</span>
                            </td>
                            
                            {{-- Tanggal --}}
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $item->created_at->format('d M Y, H:i') }} WIB
                            </td>
                            
                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    {{-- Edit --}}
                                    <a href="/admin/berita/{{ $item->id }}/edit" class="text-sm font-medium text-brand-sky hover:underline">
                                        Edit
                                    </a>
                                    <span class="text-gray-200">|</span>
                                    {{-- Hapus --}}
                                    <form action="/admin/berita/{{ $item->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');" style="display:inline;">
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
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 text-3xl mb-4 border border-gray-100">📭</div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Belum ada berita</h3>
                                <p class="text-sm text-gray-500">Mulai buat artikel pertama Anda untuk dibagikan kepada pengunjung.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        @if($posts->hasPages())
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection