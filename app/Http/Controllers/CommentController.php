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
        $post = ForumPost::with('user', 'comments.user')->findOrFail($post_id);

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

        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        // Mengirim respons JSON yang benar
        return response()->json([
            'success' => true,
            'user' => [
                'name' => auth()->user()->name,
            ],
            'content' => $comment->content
        ]);
    }
}
