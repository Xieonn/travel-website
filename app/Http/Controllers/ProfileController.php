<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memproses pembaruan data profil dan password.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // 1. Validasi Input (Nama, Email, dan Password)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Masukkan data nama dan email
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // 3. Jika email berubah, hapus status verifikasinya (Keamanan Breeze)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 4. Jika kolom password diisi, enkripsi dan perbarui
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // 5. Simpan ke database
        $user->save();

        // 6. Kembali dengan membawa session 'success' untuk memunculkan notifikasi hijau
        return Redirect::route('profile.edit')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    /**
     * Menghapus akun pengguna (Bawaan Breeze).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}