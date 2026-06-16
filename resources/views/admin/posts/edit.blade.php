@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
    {{-- Tombol Kembali --}}
    <a href="/admin/berita" class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 font-medium text-sm mb-6 transition group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Kelola Berita
    </a>

    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-1">Edit Berita</h1>
            <p class="text-gray-500 text-sm">Perbarui informasi artikel atau konten berita Anda</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-xl shadow border border-gray-100 p-6 sm:p-8">
            <form action="/admin/berita/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Input Judul --}}
                <div class="mb-5">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita</label>
                    <input type="text" name="title" id="title" 
                           class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"
                           value="{{ old('title', $post->title) }}" required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Kategori --}}
                <div class="mb-5">
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori Berita</label>
                    <select name="category" id="category" 
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition bg-white">
                        <option value="alam" {{ old('category', $post->category) == 'alam' ? 'selected' : '' }}>Wisata Alam</option>
                        <option value="budaya" {{ old('category', $post->category) == 'budaya' ? 'selected' : '' }}>Wisata Budaya</option>
                        <option value="kuliner" {{ old('category', $post->category) == 'kuliner' ? 'selected' : '' }}>Wisata Kuliner</option>
                        <option value="umum" {{ old('category', $post->category) == 'umum' ? 'selected' : '' }}>Umum / Tips Perjalanan</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Thumbnail / Gambar --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Thumbnail Berita</label>
                    
                    {{-- Preview Gambar Lama --}}
                    <div class="mb-3">
                        <p class="text-xs text-gray-400 mb-1">Gambar saat ini:</p>
                        @if($post->thumbnail)
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Current Thumbnail" class="w-48 h-32 object-cover rounded-lg border border-gray-200 shadow-sm">
                        @else
                            <div class="w-48 h-32 bg-yellow-100 rounded-lg flex items-center justify-center text-4xl border border-dashed border-gray-300">📰</div>
                        @endif
                    </div>

                    {{-- Upload Gambar Baru --}}
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <p class="text-xs text-gray-400 mt-1">Pilih file baru jika Anda ingin mengganti gambar di atas (Format: JPG, JPEG, PNG, WEBP).</p>
                    @error('thumbnail')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Konten / Isi Berita --}}
                <div class="mb-6">
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Isi Konten Berita</label>
                    <textarea name="content" id="content" rows="8" required
                              class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Aksi Akhir --}}
                <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5">
                    <a href="/admin/berita" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-700 shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection