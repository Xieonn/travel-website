@extends('layouts.app')

@section('title', 'Tambah Destinasi')

@push('styles')
<style>
    .form-container { max-width: 800px; margin: 0 auto; padding-top: 1rem; }
    .card { background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 4px 24px rgba(13, 59, 94, 0.04); border: 1px solid rgba(13, 59, 94, 0.06); }
    .card-header { font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: var(--brand-ocean); margin: 0 0 1.5rem 0; border-bottom: 1px solid rgba(13, 59, 94, 0.08); padding-bottom: 1rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: var(--brand-ink); margin-bottom: 0.5rem; }
    .form-input, .form-select, .form-textarea { width: 100%; font-family: 'DM Sans', sans-serif; font-size: 0.95rem; padding: 0.75rem 1rem; color: var(--brand-ink); background: var(--brand-mist); border: 1px solid rgba(13, 59, 94, 0.15); border-radius: 8px; transition: all 0.2s; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--brand-sky); background: white; box-shadow: 0 0 0 3px rgba(26, 111, 168, 0.1); }
    .form-input[readonly] { background: #f8fafc; cursor: not-allowed; }
    .form-textarea { resize: vertical; min-height: 120px; }
    .form-error { color: var(--brand-coral); font-size: 0.8rem; margin-top: 0.4rem; display: block; }
    .btn-submit { display: inline-flex; justify-content: center; width: 100%; font-family: 'DM Sans', sans-serif; font-size: 1rem; font-weight: 500; color: white; background: var(--brand-ocean); border: none; padding: 0.85rem; border-radius: 8px; cursor: pointer; transition: background 0.2s; margin-top: 1rem; }
    .btn-submit:hover { background: var(--brand-sky); }
    .back-link { display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #4A5568; font-size: 0.95rem; font-weight: 500; margin-bottom: 1.5rem; }
    .back-link:hover { color: var(--brand-ocean); }
    
    /* Style khusus untuk kontainer peta */
    #map { height: 350px; width: 100%; border-radius: 8px; border: 1px solid rgba(13, 59, 94, 0.15); margin-top: 0.5rem; z-index: 1; }
</style>
@endpush

@section('content')
<div class="form-container">
    <a href="{{ route('dashboard') }}" class="back-link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Kembali ke Dashboard
    </a>

    <div class="card">
        <h1 class="card-header">Tambah Destinasi Baru</h1>

        <form method="POST" action="{{ route('admin.destinasi.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama Destinasi</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" placeholder="Cth: Danau Sipin">
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Kategori Wisata</label>
                <select id="category" name="category" class="form-select">
                    <option value="" disabled selected>Pilih Kategori...</option>
                    <option value="Alam" {{ old('category') == 'Alam' ? 'selected' : '' }}>Wisata Alam</option>
                    <option value="Budaya" {{ old('category') == 'Budaya' ? 'selected' : '' }}>Wisata Budaya</option>
                    <option value="Kuliner" {{ old('category') == 'Kuliner' ? 'selected' : '' }}>Wisata Kuliner</option>
                </select>
                @error('category') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            {{-- Bagian Peta Interaktif --}}
            <div class="form-group">
                <label for="location" class="form-label">Pilih Lokasi pada Peta</label>
                <p style="font-size: 0.8rem; color: #718096; margin-top: -4px; margin-bottom: 8px;">Klik area pada peta untuk menentukan titik koordinat destinasi.</p>
                
                {{-- Input ini diset readonly agar user tidak sembarangan mengetik --}}
                <input type="text" id="location" name="location" class="form-input" value="{{ old('location') }}" placeholder="Koordinat akan otomatis terisi..." readonly>
                
                {{-- Tempat Peta Muncul --}}
                <div id="map"></div>
                
                @error('location') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi Destinasi</label>
                <textarea id="description" name="description" class="form-textarea" placeholder="Ceritakan daya tarik destinasi ini...">{{ old('description') }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Foto Destinasi (Opsional)</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Simpan Destinasi</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Inisialisasi Peta
        var map = L.map('map').setView([-1.6158, 103.5786], 12);

        // 2. Tambahkan Tile Layer (Tampilan Peta dari OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;
        var locationInput = document.getElementById('location');

        // 3. Menangani Old Value (Jika ada error validasi di form, marker tidak hilang)
        if (locationInput.value) {
            var coords = locationInput.value.split(',');
            if (coords.length === 2) {
                var lat = parseFloat(coords[0]);
                var lng = parseFloat(coords[1]);
                marker = L.marker([lat, lng]).addTo(map);
                map.setView([lat, lng], 14); // Zoom in ke marker
            }
        }

        // 4. Event Listener saat Peta diklik
        map.on('click', function(e) {
            var lat = e.latlng.lat.toFixed(6);
            var lng = e.latlng.lng.toFixed(6);

            // Hapus marker lama jika sudah ada
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambahkan marker baru di titik yang diklik
            marker = L.marker([lat, lng]).addTo(map);

            // Isi input text dengan koordinat
            locationInput.value = lat + ', ' + lng;
        });
    });
</script>
@endpush