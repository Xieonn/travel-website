<?php

namespace App\Http\Controllers;

use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        $fallbackImages = [
            'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1528701800489-20be3c7e6f4d?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1520899980257-50a89a8466d6?auto=format&fit=crop&w=900&q=80',
        ];

        return view('outdoorstore', compact('products', 'fallbackImages'));
    }
}
