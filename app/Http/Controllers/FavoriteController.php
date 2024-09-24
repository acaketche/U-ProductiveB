<?php

// app/Http/Controllers/FavoriteController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        $favorites = Favorite::with('article', 'video')->where('user_id', $user->id)->get();
        return view('favorite.index', compact('favorites', 'user'));
    }
}
