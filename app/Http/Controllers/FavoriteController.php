<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(ForumPost $post)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Logika untuk menambah atau menghapus postingan dari favorit
            $user->favorites()->toggle($post->id);

            return response()->json(['message' => 'Favorite updated!'], 200);
        } catch (\Exception $e) {
            // Log error di Laravel log dan kembalikan respons 500
            \Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with(['article', 'video'])->get();

        return view('favorite.index', compact('favorites', 'user'));
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
