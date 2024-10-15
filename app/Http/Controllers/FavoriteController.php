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
    public function toggle($post_id)
    {
        $user = auth()->user();
        $post = Post::find($post_id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        // Cek apakah postingan sudah di-favorite
        $favorite = Favorite::where('user_id', $user->id)->where('post_id', $post_id)->first();

        if ($favorite) {
            // Jika sudah di-favorite, hapus dari favorite
            $favorite->delete();
        } else {
            // Jika belum di-favorite, tambahkan ke favorite
            Favorite::create([
                'user_id' => $user->id,
                'post_id' => $post_id,
            ]);
        }

        return redirect()->back()->with('success', 'Favorite updated.');
    }
}

