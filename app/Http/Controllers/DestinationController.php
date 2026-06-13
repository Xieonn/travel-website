<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    // =======================================================
    // HALAMAN PUBLIK
    // =======================================================

    public function index()
    {
        $destinations = Destination::latest()->paginate(6);
        return view('destinations.index', compact('destinations'));
    }

    // Halaman detail satu destinasi
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return view('destinations.show', compact('destination'));
    }

    // =======================================================
    // HALAMAN KHUSUS ADMIN
    // =======================================================

    // Menampilkan halaman form tambah data
    public function create()
    {
        return view('admin.destinasi.create');
    }

    // Memproses data yang dikirim dari form
    public function store(Request $request)
    {
        // 1. Validasi input (Tanpa 'price' karena tidak ada di database Anda)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // 2. Tangani upload gambar jika ada
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder storage/app/public/destinations
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
        }

        // 3. Simpan data ke database
        Destination::create($validated);

        // 4. Arahkan kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Destinasi wisata berhasil ditambahkan!');
    }
}