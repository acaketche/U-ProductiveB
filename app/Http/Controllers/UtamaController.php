<?php
namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Video;
use Illuminate\Http\Request;

class UtamaController extends Controller
{
    public function index()
    {
        // Ambil 5 artikel teratas berdasarkan created_at (atau gunakan kolom lain untuk menentukan popularitas)
        $articles = Article::where('user_id', auth()->id())
                           ->orderBy('created_at', 'desc')
                           ->take(5)
                           ->get();

        // Ambil 5 video teratas berdasarkan created_at (atau gunakan kolom lain untuk menentukan popularitas)
        $videos = Video::where('user_id', auth()->id())
                       ->orderBy('created_at', 'desc')
                       ->take(5)
                       ->get();

        return view('index', compact('articles', 'videos'));
    }
}
