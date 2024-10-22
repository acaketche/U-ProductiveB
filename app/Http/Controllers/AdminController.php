<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ForumPost;
use App\Models\Comment;


class AdminController extends Controller
{
        public function dashboard()
        {
            return view('admin.dashboard');
        }

        public function kelolaArtikel()
        {
            $articles = Article::with('category')->paginate(10);
            return view('admin.kelola-artikel', compact('articles'));
        }

        public function kelolaVideo()
        {
            return view('admin.kelola-video');
        }

        public function logout(Request $request)
        {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
        }

        public function kelolaForum()
        {
            $forumPosts = ForumPost::with('user')->get();
            return view('admin.kelola-forum' , compact('forumPosts'));
        }

        public function destroyPost($id)
        {
            $forumPost = ForumPost::findOrFail($id);
            $forumPost->delete();

            return redirect()->route('kelola.forum')->with('success','Post Berhasil dihapus.');
        }

        public function viewComments($id)
        {
            $post = ForumPost::findOrFail($id);
            $comments = $post->comments()->with('user')->get();

            return view('admin.kelola-comments', compact('comments','post'));
        }

        public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

}
?>
