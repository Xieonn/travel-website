<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua nama peran yang ada di database
        $roles = Role::pluck('name', 'name')->all();
        
        // Mengembalikan tampilan form dan membawa data roles
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mencari pengguna berdasarkan ID, akan memunculkan error 404 jika tidak ditemukan
        $user = User::findOrFail($id);
        
        // Mengambil semua nama peran yang ada di database
        $roles = Role::pluck('name', 'name')->all();
        
        // Mengambil peran yang saat ini dimiliki oleh pengguna
        $userRoles = $user->roles->pluck('name', 'name')->all();
        
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
