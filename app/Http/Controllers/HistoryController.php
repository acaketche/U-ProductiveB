<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon; // Mengimpor Carbon dengan benar
use App\Models\History;
use App\Models\TeknikSipil;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mendapatkan informasi pengguna yang sedang login
    $histories = History::with(['article', 'video', 'teknik_sipils', 'informatics' , 'teknik_computers'])->orderBy('viewed_at', 'desc')->get();

        return view('history.index', compact('histories', 'user')) ;
    }


    public function showHistory()
{
    $histories = History::where('user_id', auth()->id())
        ->where('viewed_at', '>=', Carbon::now()->subDays(30)) // Mengambil data 30 hari terakhir
        ->orderByDesc('viewed_at') // Mengurutkan berdasarkan viewed_at dari yang terbaru
        ->with(['article', 'video' , 'informatics' , 'teknik_sipils' , 'teknik_computers'])
        ->get()
        ->each(function ($history) {
            $history->viewed_at = $history->viewed_at->setTimezone('Asia/Jakarta'); // Menyesuaikan timezone
        });

    return view('history', compact('histories'));
}


}
