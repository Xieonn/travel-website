<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        // Mengambil 8 produk terbaru dari database
        $products = Product::latest()->take(8)->get();

        // Mengirim data ke view
        return view('outdoorstore', compact('products'));
    }
}