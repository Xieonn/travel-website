<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Destination;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $beritaTerbaru = Post::latest()->take(3)->get();
        $destinations = Destination::latest()->take(3)->get();
        $products = Product::latest()->take(4)->get();

        return view('home', compact('beritaTerbaru', 'destinations', 'products'));
    }   
}