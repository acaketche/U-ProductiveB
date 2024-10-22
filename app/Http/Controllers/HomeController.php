<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data artikel dan video dari database
        $articles = Article::all();
        $videos = Video::all();

        // Menampilkan view 'home' dengan data
        return view('home', compact('articles', 'videos'));
    }
}
