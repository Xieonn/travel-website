<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
        {
        // 1. Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'location' => 'required|string|max:255', // Ini kembali menjadi teks biasa
                'latitude' => 'required|numeric',        // Kolom khusus koordinat
                'longitude' => 'required|numeric',       // Kolom khusus koordinat
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

        // 2. Tangani upload gambar jika ada
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('destinations', 'public');
                $validated['image'] = $imagePath;
            }

        // 3. Simpan data ke database
            Destination::create($validated);

            return redirect()->route('dashboard')->with('success', 'Destinasi wisata berhasil ditambahkan!');
        }
        // Menghapus data destinasi
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);

        // Hapus file gambar dari storage jika ada
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        // Hapus data dari database
        $destination->delete();

        // Kembalikan ke halaman sebelumnya (atau beranda) dengan pesan sukses
        return redirect('/')->with('success', 'Destinasi berhasil dihapus secara permanen.');
    }


    // Menampilkan halaman form edit dengan data lama
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        return view('admin.destinasi.edit', compact('destination'));
    }

    // Memproses pembaruan data
    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Jika Admin mengunggah foto baru
        if ($request->hasFile('image')) {
            // Hapus foto lama dari storage fisik server jika ada
            if ($destination->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($destination->image);
            }
            // Simpan foto baru
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
        }

        // Perbarui data di database
        $destination->update($validated);

        return redirect()->route('dashboard')->with('success', 'Data destinasi berhasil diperbarui!');
    }
}