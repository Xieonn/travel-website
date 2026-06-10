<?php

namespace App\Http\Controllers;

use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        // Hanya mengambil data produk dari database
        $products = Product::latest()->get();

        // Melempar variabel $products saja ke halaman blade
        return view('outdoorstore', compact('products'));
    }
}
