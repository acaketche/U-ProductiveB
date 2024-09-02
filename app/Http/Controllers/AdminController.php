<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
        public function dashboard()
        {
            return view('admin.dashboard');
        }



        public function kelolaArtikel()
        {
            return view('admin.kelola-artikel');
        }

        public function kelolaVideo()
        {
            return view('admin.kelola-video');
        }

        public function kelolaForum()
        {
            return view('admin.kelola-forum');
        }

}
?>
