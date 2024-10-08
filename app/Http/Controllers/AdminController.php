<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
            return view('admin.kelola-forum');
        }

}
?>
