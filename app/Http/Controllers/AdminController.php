<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ForumPost;
use App\Models\Comment;
use PDF;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function kelolaUser(Request $request)
    {
        $query = User::query();
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('user_id', 'LIKE', "%{$search}%");
            });
        }
        // Filter Role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        // Export PDF
        if ($request->has('export')) {
            return $this->exportPDF($query->get());
        }
        // Pagination dengan query parameters
        $users = $query->paginate(10)->withQueryString();
        return view('admin.kelola-user', compact('users'));
    }

     private function exportPDF($users)
    {
        $pdf = PDF::loadView('admin.pdf.users', compact('users'));

        // Simpan PDF ke storage sementara
        $filename = 'users-report-' . time() . '.pdf';
        Storage::put('public/temp/' . $filename, $pdf->output());

        // Download file
        return response()->download(storage_path('app/public/temp/' . $filename))
            ->deleteFileAfterSend(true);
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
        return view('admin.kelola-forum', compact('forumPosts'));
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
