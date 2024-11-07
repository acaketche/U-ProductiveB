<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Metode untuk menambahkan/menghapus favorit
    public function toggle(Request $request)
    {
        $postId = $request->input('post_id');
        $userId = Auth::id(); // Dapatkan ID user yang sedang login

        // Cek apakah postingan sudah difavoritkan oleh user
        $favorite = Favorite::where('post_id', $postId)->where('user_id', $userId)->first();

        if ($favorite) {
            // Jika sudah ada, hapus dari favorit
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // Jika belum ada, tambahkan ke favorit
            Favorite::create([
                'post_id' => $postId,
                'user_id' => $userId,
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    // Menampilkan daftar favorit
    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with(['article', 'video'])->orderBy('created_at', 'desc')->get();

        return view('favorite.index', compact('favorites', 'user'));
    }

    // Menyimpan favorit untuk artikel atau forum post
    public function store(Request $request, $post_id)
    {
        // Logika untuk menambah favorit
        $favorite = new Favorite;
        $favorite->user_id = Auth::id();
        $favorite->post_id = $post_id;
        $favorite->save();

        return back()->with('success', 'Favorite berhasil ditambahkan');
    }

    public function destroy(Request $request, $post_id)
    {
        // Logika untuk menghapus favorit
        Favorite::where('user_id', Auth::id())->where('post_id', $post_id)->delete();

        return back()->with('success', 'Favorite berhasil dihapus');
    }


    public function favorite(ForumPost $post)
    {
        Auth::user()->favorites()->attach($post->id);
        return back();
    }

    public function unfavorite($postId)
    {
        $post = ForumPost::findOrFail($postId);

        // Hapus dari tabel favorit
        Favorite::where('user_id', Auth::id())
                ->where('post_id', $post->post_id)
                ->delete();

        return redirect()->route('favorite.index', ['post' => $postId])
                        ->with('success', 'Post telah dihapus dari favorit');
    }
}
