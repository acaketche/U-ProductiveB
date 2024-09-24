<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ForumPost; // Model yang sesuai
use App\Models\User;

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
}
