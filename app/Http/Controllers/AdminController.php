<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ForumPost;
use App\Models\Comment;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function createUser()
{
    return view('admin.tambah-user');
}

public function storeUser(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,dosen,mahasiswa',
    ]);

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' =>$request->input('password'),
        'role' => $request->input('role'),
    ]);

    return redirect()->route('kelola.user')->with('success', 'User baru berhasil ditambahkan.');
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

    public function kelolaForum(Request $request)
    {
        $query = ForumPost::with('user');

    // Search
    if ($request->filled('search')) {
        $query->where('content', 'like', '%' . $request->search . '%');
    }

    // Filter by user
    if ($request->filled('user')) {
        $query->where('user_id', $request->user);
    }

    // Filter by date range
    if ($request->filled('date_range')) {
        switch ($request->date_range) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                break;
        }
    }

    // Get all users for the filter dropdown
    $users = User::all();

    // Get paginated results
    $forumPosts = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.kelola-forum', compact('forumPosts', 'users'));
    }

    public function destroyPost($id)
    {
        $forumPost = ForumPost::findOrFail($id);
        $forumPost->delete();
        return redirect()->route('kelola.forum')->with('success','Post Berhasil dihapus.');
    }

    public function viewComments(Request $request, $id)
    {
        $post = ForumPost::findOrFail($id);
        $query = Comment::with('user')->where('post_id', $id);

        // Search
        if ($request->filled('search')) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }

        // Filter by user
        if ($request->filled('user')) {
            $query->where('user_id', $request->user);
        }

        // Get all users for the filter dropdown
        $users = User::all();

        // Get paginated results
        $comments = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.kelola-comments', compact('post', 'comments', 'users'));
    }

    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
