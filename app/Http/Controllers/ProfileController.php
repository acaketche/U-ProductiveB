<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna sudah terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengakses profil Anda.');
        }

        $user = Auth::user();
        $articles = $user->articles; // Pastikan relasi articles ada dalam model User
        $videos = $user->videos; // Pastikan relasi videos ada dalam model User
        $history = $user->history; // Pastikan relasi history ada dalam model User

        return view('user.user-profile', compact('user', 'articles', 'videos', 'history'));
    }

    public function edit()
    {
        // Periksa apakah pengguna sudah terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengedit profil Anda.');
        }

        $user = Auth::user();

        return view('user.edit-profile', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    // Validasi
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
        'password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk gambar
    ]);

    // Update data profil user
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Periksa apakah password baru diisi
    if ($request->filled('password')) {
        // Hash dan simpan password baru
        $user->password = $request->input('password');
    }

    // Periksa apakah ada upload foto profile baru
    if ($request->hasFile('profile_picture')) {
        // Hapus foto lama jika ada
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Simpan foto profile baru
        $path = $request->file('profile_picture')->store('images', 'public');
        $user->profile_picture = $path;
    }

    $user->save();

    return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
}

}
