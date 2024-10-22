<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create($post_id)
    {
        // Ambil data postingan berdasarkan ID
        $post = ForumPost::findOrFail($post_id);

        // Tampilkan view form komentar dengan data postingan
        return view('forum.tambah-komentar', compact('post'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'post_id' => 'required|exists:forum_post,post_id',
            'content' => 'required|string|max:255',
        ]);

        // Buat komentar baru
        $comment = new Comment();
        $comment->post_id = $validatedData['post_id'];
        $comment->user_id = auth()->id(); // ID user yang saat ini login
        $comment->content = $validatedData['content'];
        $comment->save();

        // // Ambil waktu pembuatan dari komentar yang baru saja disimpan
        // $createdAt = $comment->created_at ? $comment->created_at->format('d M Y') : 'Waktu tidak tersedia';

        // Mengembalikan respons JSON
        return response()->json([
            'user' => [
                'name' => $comment->user->name,
            ],
            'content' => $comment->content,
        ]);
    }
}
