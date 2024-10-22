<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\History;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mendapatkan informasi pengguna yang sedang login
        $histories = History::with(['article', 'video', 'forumPost'])->where('user_id', $user->id)->get();

        return view('history.index', compact('histories', 'user'));
    }


    public function showHistory()
{
    $histories = History::where('user_id', auth()->id())
        ->orderBy('viewed_at', 'desc')
        ->with(['article', 'video'])
        ->get();

    return view('history', compact('histories'));
}

}
