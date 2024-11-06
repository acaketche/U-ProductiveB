<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ForumPost; // Model yang sesuai
use App\Models\User;
use App\Models\Favorite; // Pastikan ini ada

class ForumController extends Controller
{
    /**
     * Tampilkan halaman forum.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua forum post dengan relasi yang diperlukan
        $posts = ForumPost::orderBy('created_at', 'desc')->get();

        $user = Auth::user();

        // Mengirimkan data forum post ke view 'forum'
        return view('forum.halaman-utama', compact('posts', 'user'));
    }

    public function create()
    {
        return view('forum.tambah-postingan'); // Mengarahkan ke view 'create.blade.php'
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        ForumPost::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forum.index'); // Mengarahkan kembali ke halaman forum setelah postingan dibuat
    }

    // public function favorites()
    // {
    //     $favorites = Auth::user()->favorites;

    //     return view('favorite.index', compact('favorites'));
    // }

    public function show($id)
    {
        $post = ForumPost::findOrFail($id);

        // Cek apakah postingan sudah difavoritkan oleh pengguna yang sedang login
        $isFavorited = $post->favorited ? true : false;

        return view('forum.show', compact('post', 'isFavorited'));
    }

    public function favorite($postId)
    {
        $post = ForumPost::findOrFail($postId);

        // Simpan ke tabel favorit
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->post_id = $post->post_id;
        $favorite->save();

        return redirect()->route('favorite.index', ['post' => $postId])
                        ->with('success', 'Post telah ditambahkan ke favorit');
    }

    public function toggleFavorite(Post $post)
    {
        $user = Auth::user();

        if ($user->favorites()->where('post_id', $post->id)->exists()) {
            $user->favorites()->detach($post->id);
            return response()->json(['message' => 'Favorit dihapus']);
        } else {
            $user->favorites()->attach($post->id);
            return response()->json(['message' => 'Ditambahkan ke favorit']);
        }
    }
}
