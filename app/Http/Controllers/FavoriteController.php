<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
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

    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with(['article', 'video'])->get();

        return view('favorite.index', compact('favorites', 'user'));
    }

    public function store($postId)
    {
        try {
            // Cek apakah post dengan ID tersebut ada
            $post = ForumPost::findOrFail($postId);

            // Logika untuk menambah atau menghapus favorit
            $user = Auth::user();
            $user->favorites()->toggle($postId);

            return response()->json(['message' => 'Post favorit berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error saat menyimpan favorit: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan favorit'], 500);
        }
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
