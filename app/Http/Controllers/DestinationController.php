<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
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
}
