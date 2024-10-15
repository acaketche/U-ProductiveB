<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Video;
use Illuminate\Http\Request;

class UtamaController extends Controller
{
    public function index()
    {

        // Ambil data artikel dan video berdasarkan user yang sedang login
        $articles = Article::where('user_id', auth()->id())->get(); // Menampilkan artikel sesuai user yang login
        $videos = Video::where('user_id', auth()->id())->get(); // Menampilkan video sesuai user yang login

        return view('index', compact('articles', 'videos'));
    }
}
