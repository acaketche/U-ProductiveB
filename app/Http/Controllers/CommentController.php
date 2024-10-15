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
            'post_id' => 'required|exists:forum_post,post_id', // Pastikan tabelnya forum_posts
            'content' => 'required|string'
        ]);

        // Simpan komentar baru ke database
        Comment::create([
            'post_id' => $validatedData['post_id'],
            'content' => $validatedData['content'],
            'user_id' => auth()->id() // Mengaitkan komentar dengan user yang login
        ]);

        // Redirect kembali ke halaman forum atau halaman detail postingan
        return redirect()->route('forum.index')->with('success', 'Komentar berhasil ditambahkan!');
    }
}
