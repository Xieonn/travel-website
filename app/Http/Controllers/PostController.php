<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('user')
            ->when($request->category, function($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->latest()
            ->paginate(12);

        return view('posts.index', compact('posts'));
    }

    public function show(string$id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // ... method index dan show sebelumnya ...

    // 1. Menampilkan halaman tabel Kelola Berita (Dashboard Admin)
    public function adminIndex()
    {
        // Mengambil data untuk admin, mungkin tidak perlu difilter per kategori
        $posts = Post::latest()->paginate(10);
        
        // Mengarahkan ke file view admin/berita/index.blade.php yang tadi kita buat
        return view('admin.posts.index', compact('posts'));
    }

    // 2. Menampilkan formulir tambah berita
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'thumbnail' => 'nullable|image|max:2048', // Validasi untuk file gambar
        ]);

        $data = $request->only('title', 'content', 'category');
        $data['user_id'] = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Post::create($data);

        return redirect('/admin/berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    // 5. Menyimpan perubahan data berita
    public function update(Request $request, $id)
    {
        // 1. Validasi input (thumbnail dibuat nullable karena admin tidak wajib ganti gambar)
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'thumbnail' => 'nullable|image|max:2048', 
        ]);

        // 2. Cari data berita yang ingin diedit
        $post = Post::findOrFail($id);

        // 3. Ambil data teks yang baru
        $data = $request->only('title', 'content', 'category');

        // 4. Logika penanganan gambar JIKA admin mengunggah gambar baru
        if ($request->hasFile('thumbnail')) {
            
            // Hapus gambar lama dari folder public/storage jika sebelumnya ada gambar
            if ($post->thumbnail && Storage::exists('public/' . $post->thumbnail)) {
                Storage::delete('public/' . $post->thumbnail);
            }

            // Simpan gambar baru ke folder public/thumbnails
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // 5. Lakukan update data ke database
        $post->update($data);

        // 6. Kembalikan ke halaman daftar dengan pesan sukses
        return redirect('/admin/berita')->with('success', 'Berita berhasil diperbarui!');
    }

    // 3. Menghapus data berita
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        
        // Hapus file thumbnail jika ada
        if ($post->thumbnail && Storage::exists('public/' . $post->thumbnail)) {
            Storage::delete('public/' . $post->thumbnail);
        }
        
        $post->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }
}