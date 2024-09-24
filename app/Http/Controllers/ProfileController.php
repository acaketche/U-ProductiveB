<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $articles = $user->articles;
        $videos = $user->videos;
        $history = $user->history;

        return view('user.user-profile', compact('user', 'articles', 'videos', 'history'));
    }


    public function edit()
    {
        $user = Auth::user();

        return view('user.edit-profile', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
        'password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
    ]);

    // Update the user's profile data
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    if ($request->hasFile('profile_picture')) {
        // Delete the old profile photo if it exists
        if ($user->profile_picture) {
            // Hapus file lama dari direktori public
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store the new profile photo in the 'public/images' folder
        $path = $request->file('profile_picture')->store('images', 'public');

        // Update the user's profile picture path
        $user->profile_picture = $path;
    }

    $user->save();

    return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
}
}
