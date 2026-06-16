@extends('layouts.app')

@section('title', 'Edit Destinasi')

@push('styles')
<style>
    .form-container { max-width: 800px; margin: 0 auto; padding-top: 1rem; }
    .card { background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 4px 24px rgba(13, 59, 94, 0.04); border: 1px solid rgba(13, 59, 94, 0.06); }
    .card-header { font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: var(--brand-ocean); margin: 0 0 1.5rem 0; border-bottom: 1px solid rgba(13, 59, 94, 0.08); padding-bottom: 1rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: var(--brand-ink); margin-bottom: 0.5rem; }
    .form-input, .form-select, .form-textarea { width: 100%; font-family: 'DM Sans', sans-serif; font-size: 0.95rem; padding: 0.75rem 1rem; color: var(--brand-ink); background: var(--brand-mist); border: 1px solid rgba(13, 59, 94, 0.15); border-radius: 8px; transition: all 0.2s; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--brand-sky); background: white; box-shadow: 0 0 0 3px rgba(26, 111, 168, 0.1); }
    .form-input[readonly] { background-color: #f1f5f9; color: #64748b; cursor: not-allowed; }
    .form-textarea { resize: vertical; min-height: 120px; }
    .form-error { color: var(--brand-coral); font-size: 0.8rem; margin-top: 0.4rem; display: block; }
    .btn-submit { display: inline-flex; justify-content: center; width: 100%; font-family: 'DM Sans', sans-serif; font-size: 1rem; font-weight: 500; color: white; background: var(--brand-ocean); border: none; padding: 0.85rem; border-radius: 8px; cursor: pointer; transition: background 0.2s; margin-top: 1rem; }
    .btn-submit:hover { background: var(--brand-sky); }
    .back-link { display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #4A5568; font-size: 0.95rem; font-weight: 500; margin-bottom: 1.5rem; }
    .back-link:hover { color: var(--brand-ocean); }
    #map { height: 350px; width: 100%; border-radius: 8px; border: 1px solid rgba(13, 59, 94, 0.15); z-index: 1; }
</style>
@endpush

@section('content')
<div class="form-container">
    <a href="{{ route('dashboard') }}" class="back-link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Batal dan Kembali
    </a>

    <div class="card">
        <h1 class="card-header">Edit Destinasi</h1>

        <form method="POST" action="{{ route('admin.destinasi.update', $destination->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Nama Destinasi</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $destination->name) }}">
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Kategori Wisata</label>
                <select id="category" name="category" class="form-select">
                    <option value="Alam" {{ old('category', $destination->category) == 'Alam' ? 'selected' : '' }}>Wisata Alam</option>
                    <option value="Budaya" {{ old('category', $destination->category) == 'Budaya' ? 'selected' : '' }}>Wisata Budaya</option>
                    <option value="Kuliner" {{ old('category', $destination->category) == 'Kuliner' ? 'selected' : '' }}>Wisata Kuliner</option>
                </select>
                @error('category') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="location" class="form-label">Alamat / Lokasi Destinasi</label>
                <input type="text" id="location" name="location" class="form-input" value="{{ old('location', $destination->location) }}">
                @error('location') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="padding: 1.5rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
                <label class="form-label" style="font-size: 1rem; color: var(--brand-ocean);">Titik Koordinat Peta</label>
                <p style="font-size: 0.85rem; color: #64748b; margin-top: -4px; margin-bottom: 12px;">Klik area pada peta untuk memperbarui koordinat.</p>
                
                <div id="map"></div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                    <div>
                        <label for="latitude" class="form-label" style="font-size: 0.8rem;">Latitude (Lintang)</label>
                        <input type="text" id="latitude" name="latitude" class="form-input" value="{{ old('latitude', $destination->latitude) }}" readonly>
                    </div>
                    <div>
                        <label for="longitude" class="form-label" style="font-size: 0.8rem;">Longitude (Bujur)</label>
                        <input type="text" id="longitude" name="longitude" class="form-input" value="{{ old('longitude', $destination->longitude) }}" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi Destinasi</label>
                <textarea id="description" name="description" class="form-textarea">{{ old('description', $destination->description) }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Foto Destinasi (Biarkan kosong jika tidak ingin mengubah foto)</label>
                @if($destination->image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $destination->image) }}" alt="Foto saat ini" style="height: 80px; border-radius: 8px;">
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Perbarui Destinasi</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var initialLat = {{ old('latitude', $destination->latitude ?? -1.6158) }};
        var initialLng = {{ old('longitude', $destination->longitude ?? 103.5786) }};
        
        var map = L.map('map').setView([initialLat, initialLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        var latInput = document.getElementById('latitude');
        var lngInput = document.getElementById('longitude');
        var marker = L.marker([initialLat, initialLng]).addTo(map);

        map.on('click', function(e) {
            var lat = e.latlng.lat.toFixed(6);
            var lng = e.latlng.lng.toFixed(6);

            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);

            latInput.value = lat;
            lngInput.value = lng;
        });
    });
</script>
@endpush