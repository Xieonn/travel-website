@extends('layouts.app')

@section('title', 'Tambah Produk Baru - Seller')

@push('styles')
<style>
    .seller-form-page {
        max-width: 780px;
        margin: 0 auto;
    }

    .form-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .form-header h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--brand-ocean);
        margin: 0;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: background 0.2s, color 0.2s;
    }

    .btn-back:hover {
        background: rgba(13,59,94,0.06);
        color: var(--brand-ocean);
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 14px;
        border: 1px solid rgba(13,59,94,0.06);
        box-shadow: 0 2px 12px rgba(13,59,94,0.04);
        padding: 2rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #475569;
        letter-spacing: 0.01em;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group select,
    .form-group textarea {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        padding: 0.65rem 0.9rem;
        border: 1px solid rgba(13,59,94,0.15);
        border-radius: 10px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: white;
        color: var(--brand-ink);
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--brand-sky);
        box-shadow: 0 0 0 3px rgba(26,111,168,0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    /* Image Upload */
    .image-upload-area {
        border: 2px dashed rgba(13,59,94,0.15);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        position: relative;
    }

    .image-upload-area:hover {
        border-color: var(--brand-sky);
        background: rgba(26,111,168,0.02);
    }

    .image-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .upload-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .upload-text {
        font-size: 0.85rem;
        color: #64748b;
    }

    .upload-text strong {
        color: var(--brand-sky);
    }

    .upload-hint {
        font-size: 0.75rem;
        color: #94a3b8;
        margin-top: 0.25rem;
    }

    .image-preview {
        margin-top: 1rem;
        display: none;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 150px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid rgba(13,59,94,0.1);
    }

    /* Errors */
    .form-errors {
        background: rgba(239,68,68,0.06);
        border: 1px solid rgba(239,68,68,0.2);
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    .form-errors p {
        font-size: 0.85rem;
        font-weight: 600;
        color: #991B1B;
        margin: 0 0 0.5rem;
    }

    .form-errors ul {
        margin: 0;
        padding-left: 1.25rem;
    }

    .form-errors li {
        font-size: 0.82rem;
        color: #991B1B;
        margin-bottom: 2px;
    }

    /* Submit */
    .form-actions {
        margin-top: 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    .btn-submit {
        font-family: 'DM Sans', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, var(--brand-sky), var(--brand-ocean));
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.7rem 1.75rem;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.2s;
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(26,111,168,0.3);
    }

    @media (max-width: 600px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-card { padding: 1.25rem; }
    }
</style>
@endpush

@section('content')
<div class="seller-form-page">

    <div class="form-header">
        <div>
            <a href="{{ route('seller.products.index') }}" class="btn-back">← Kembali ke Katalog</a>
            <h1>Tambah Produk Baru</h1>
        </div>
    </div>

    @if($errors->any())
    <div class="form-errors">
        <p>⚠ Terjadi kesalahan:</p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-card">
        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="name">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: The North Face Trailblazer 45L" required>
                </div>

                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Alat hiking" {{ old('category') == 'Alat hiking' ? 'selected' : '' }}>Alat Hiking</option>
                        <option value="pakaian" {{ old('category') == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                        <option value="Carrier" {{ old('category') == 'Carrier' ? 'selected' : '' }}>Carrier</option>
                        <option value="Tenda" {{ old('category') == 'Tenda' ? 'selected' : '' }}>Tenda</option>
                        <option value="Sepatu" {{ old('category') == 'Sepatu' ? 'selected' : '' }}>Sepatu</option>
                        <option value="Jaket" {{ old('category') == 'Jaket' ? 'selected' : '' }}>Jaket</option>
                        <option value="Aksesoris" {{ old('category') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                        <option value="Sleeping Gear" {{ old('category') == 'Sleeping Gear' ? 'selected' : '' }}>Sleeping Gear</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="2500000" min="0" required>
                </div>

                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0" required>
                </div>



                <div class="form-group full-width">
                    <label for="description">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="4" placeholder="Deskripsikan produk Anda secara detail..." required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label>Gambar Produk</label>
                    <div class="image-upload-area" id="uploadArea">
                        <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png,image/jpg,image/webp">
                        <div class="upload-icon">📷</div>
                        <div class="upload-text">Klik atau seret gambar ke sini untuk <strong>mengunggah</strong></div>
                        <div class="upload-hint">Format: JPG, PNG, WEBP • Maks 2MB</div>
                    </div>
                    <div class="image-preview" id="imagePreview">
                        <img id="previewImg" src="" alt="Preview">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan Produk</button>
            </div>
        </form>
    </div>

</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
