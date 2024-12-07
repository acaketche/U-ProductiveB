<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // Validasi user terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $search = $request->input('search');
        $time = $request->input('time');

        // Mulai query untuk history user
        $query = History::where('user_id', $user->user_id)
            ->with([
                'article' => function ($query) {
                    $query->select('article_id', 'title');
                },
                'video' => function ($query) {
                    $query->select('video_id', 'title');
                },
                'informatics' => function ($query) {
                    $query->select('if_id', 'title');
                },
                'teknik_sipils' => function ($query) {
                    $query->select('ts_id', 'title');
                },
                'teknik_computers' => function ($query) {
                    $query->select('tk_id', 'title');
                },
            ]);

        // Tambahkan filter berdasarkan pencarian
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('article', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('video', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('informatics', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('teknik_sipils', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('teknik_computers', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                });
            });
        }

        // Tambahkan filter berdasarkan waktu
        if ($time == '24 Jam') {
            $query->where('created_at', '>=', now()->subDay());
        } elseif ($time == '1 Minggu') {
            $query->where('created_at', '>=', now()->subWeek());
        } elseif ($time == '1 Bulan') {
            $query->where('created_at', '>=', now()->subMonth());
        }

        // Eksekusi query
        $histories = $query->orderByDesc('viewed_at')->get()
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
