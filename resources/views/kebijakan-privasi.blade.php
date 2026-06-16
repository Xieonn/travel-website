{{-- Mengambil master layout --}}
@extends('layouts.app')

@section('title', 'Kebijakan Privasi')

@push('styles')
<style>
    /* ── PRIVACY POLICY SPECIFIC STYLES ──────────────────────── */
    .legal-hero {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(135deg, rgba(13,59,94,0.03), rgba(26,111,168,0.05));
        border-radius: 24px;
        margin-bottom: 3rem;
    }

    .legal-hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        color: var(--brand-ocean);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .legal-hero p {
        font-size: 1.1rem;
        color: #4A5568;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Container untuk teks panjang agar nyaman dibaca */
    .legal-content {
        max-width: 850px;
        margin: 0 auto;
        background: white;
        padding: 3.5rem 4rem;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(13,59,94,0.04);
        color: #4A5568;
        line-height: 1.8;
        font-size: 1rem;
    }

    .legal-content h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        color: var(--brand-ink);
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(13,59,94,0.1);
    }

    .legal-content h2:first-child {
        margin-top: 0;
    }

    .legal-content h3 {
        font-size: 1.15rem;
        color: var(--brand-ocean);
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .legal-content p {
        margin-bottom: 1.25rem;
    }

    .legal-content ul {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .legal-content li {
        margin-bottom: 0.5rem;
    }

    .legal-content a {
        color: var(--brand-sky);
        text-decoration: none;
        font-weight: 500;
    }

    .legal-content a:hover {
        color: var(--brand-ocean);
        text-decoration: underline;
    }

    .last-updated {
        font-size: 0.875rem;
        color: #718096;
        font-style: italic;
        margin-bottom: 2rem;
        display: block;
    }

    /* Responsivitas untuk layar kecil */
    @media (max-width: 768px) {
        .legal-hero h1 { font-size: 2.25rem; }
        .legal-content { padding: 2rem 1.5rem; }
    }
</style>
@endpush

@section('content')

    {{-- Header Halaman Legal --}}
    <section class="legal-hero">
        <h1>Kebijakan Privasi</h1>
        <p>Kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda dengan standar keamanan tertinggi.</p>
    </section>

    {{-- Konten Kebijakan Privasi --}}
    <section class="legal-content">
        <span class="last-updated">Terakhir diperbarui: 15 Juni 2026</span>

        <h2>1. Pendahuluan</h2>
        <p>Selamat datang di <strong>{{ config('app.name', 'Travel Website') }}</strong>. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, memproses, dan melindungi informasi pribadi Anda saat Anda menggunakan layanan website kami untuk merencanakan dan memesan perjalanan Anda.</p>

        <h2>2. Informasi yang Kami Kumpulkan</h2>
        <p>Untuk memberikan layanan perjalanan yang optimal, kami mungkin mengumpulkan beberapa jenis informasi berikut:</p>
        <ul>
            <li><strong>Informasi Identitas:</strong> Nama lengkap, tanggal lahir, dan salinan identitas (KTP/Paspor) yang diperlukan untuk proses pemesanan tiket atau akomodasi.</li>
            <li><strong>Informasi Kontak:</strong> Alamat email, nomor telepon, dan alamat domisili.</li>
            <li><strong>Informasi Pembayaran:</strong> Detail transaksi (kami tidak menyimpan nomor kartu kredit secara langsung, melainkan dikelola oleh *payment gateway* pihak ketiga yang aman).</li>
            <li><strong>Informasi Perjalanan:</strong> Preferensi destinasi, riwayat perjalanan, dan kebutuhan khusus (misalnya diet atau aksesibilitas).</li>
        </ul>

        <h2>3. Penggunaan Informasi</h2>
        <p>Data yang kami kumpulkan semata-mata digunakan untuk tujuan berikut:</p>
        <ul>
            <li>Memproses reservasi tiket, hotel, dan paket wisata yang Anda pesan.</li>
            <li>Berkomunikasi dengan Anda mengenai detail perjalanan, perubahan jadwal, atau keadaan darurat.</li>
            <li>Meningkatkan kualitas layanan dan antarmuka pengguna di website kami.</li>
            <li>Mengirimkan promosi khusus atau buletin (*newsletter*) jika Anda telah memberikan persetujuan (Anda dapat berhenti berlangganan kapan saja).</li>
        </ul>

        <h2>4. Pembagian Informasi dengan Pihak Ketiga</h2>
        <p>Sebagai agen perjalanan, kami perlu membagikan sebagian data Anda dengan mitra penyedia layanan, seperti:</p>
        <p>Maskapai penerbangan, hotel, operator tur lokal, dan penyedia asuransi perjalanan. Informasi yang dibagikan hanya sebatas yang diperlukan untuk mengonfirmasi dan melaksanakan pesanan Anda. Kami tidak pernah menjual atau menyewakan data pribadi Anda kepada pihak ketiga untuk tujuan pemasaran di luar layanan kami.</p>

        <h2>5. Keamanan Data</h2>
        <p>Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang ketat untuk melindungi data pribadi Anda dari akses, perubahan, atau penghancuran yang tidak sah. Protokol enkripsi (*SSL/TLS*) digunakan saat mentransmisikan data sensitif selama proses pembayaran.</p>

        <h2>6. Hak-Hak Anda</h2>
        <p>Anda memiliki kendali atas informasi pribadi Anda. Anda berhak untuk:</p>
        <ul>
            <li>Mengakses atau meminta salinan data pribadi Anda yang kami simpan.</li>
            <li>Meminta koreksi jika terdapat data yang tidak akurat.</li>
            <li>Meminta penghapusan akun dan data Anda dari sistem kami (sesuai dengan ketentuan hukum yang berlaku).</li>
        </ul>

        <h2>7. Perubahan pada Kebijakan Ini</h2>
        <p>Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu untuk menyesuaikan dengan perubahan operasional atau regulasi. Kami akan memberitahukan pembaruan signifikan melalui email atau pengumuman di website ini.</p>

        <h2>8. Hubungi Kami</h2>
        <p>Jika Anda memiliki pertanyaan lebih lanjut mengenai bagaimana kami menangani privasi Anda, silakan hubungi Tim Perlindungan Data kami melalui halaman <a href="/kontak">Pusat Bantuan</a> atau kirimkan email langsung ke <a href="mailto:privacy@travelkami.com">privacy@travelkami.com</a>.</p>

    </section>

@endsection