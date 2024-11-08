<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Validasi user terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Mengambil history dengan eager loading untuk semua relasi
        $histories = History::where('user_id', $user->user_id)
            ->with([
                'article' => function($query) {
                    $query->select('article_id', 'title');
                },
                'video' => function($query) {
                    $query->select('video_id', 'title');
                },
                'informatics' => function($query) {
                    $query->select('if_id', 'title');
                },
                'teknik_sipils' => function($query) {
                    $query->select('ts_id', 'title');
                },
                'teknik_computers' => function($query) {
                    $query->select('tk_id', 'title');
                }
            ])
            ->orderByDesc('viewed_at')
            ->get()
            ->each(function ($history) {
                if ($history->viewed_at) {
                    $history->viewed_at = Carbon::parse($history->viewed_at)
                        ->timezone('Asia/Jakarta');
                }
            });

        // Return view dengan data yang diperlukan
        return view('history.index', compact('histories'));
    }
}
