<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('outdoorstore', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['reviews.user', 'seller']);
        $reviews = $product->reviews()->latest()->get();
        $avgRating = $product->averageRating();
        $reviewCount = $product->reviewCount();

        // Distribusi rating 1–5
        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingDistribution[$i] = $product->reviews()->where('rating', $i)->count();
        }

        $userReview = null;
        $hasPurchased = false;

        if (Auth::check()) {
            $userReview = ProductReview::where('product_id', $product->id)
                ->where('user_id', Auth::id())
                ->first();

            // Cek apakah user sudah membeli dan pembayaran selesai (status = paid)
            $hasPurchased = \App\Models\Transaction::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->where('status', 'paid')
                ->exists();
        }

        // Gambar produk
        $image = $product->image;
        if (!$image) {
            $fallback = ['terra45.webp', 'vectiv.webp', 'tenda.webp', 'jaket.webp'];
            $image = asset('images/' . $fallback[$product->id % 4]);
        } elseif (!\Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])) {
            $image = asset('storage/' . $image);
        }

        return view('products.show', compact(
            'product', 'reviews', 'avgRating', 'reviewCount',
            'ratingDistribution', 'userReview', 'image', 'hasPurchased'
        ));
    }

    public function storeReview(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk memberikan ulasan.');
        }

        // Hanya pembeli yang sudah lunas yang boleh review
        $hasPurchased = \App\Models\Transaction::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('status', 'paid')
            ->exists();

        if (!$hasPurchased) {
            return redirect()->route('products.show', $product)
                ->with('error', 'Anda hanya bisa memberikan ulasan setelah membeli dan menyelesaikan pembayaran produk ini.');
        }

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Upsert: update jika sudah ada, buat baru jika belum
        ProductReview::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => Auth::id()],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        // Update rata-rata rating di tabel products
        $avg = $product->reviews()->avg('rating');
        $product->update(['rating' => round($avg, 1)]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Ulasan Anda berhasil disimpan!');
    }

    public function destroyReview(Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        ProductReview::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->delete();

        // Update rata-rata
        $avg = $product->reviews()->avg('rating') ?? 0;
        $product->update(['rating' => round($avg, 1)]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Ulasan berhasil dihapus.');
    }
}
