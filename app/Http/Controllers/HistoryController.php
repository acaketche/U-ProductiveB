<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Data history (ini bisa diambil dari database atau dibuat dummy dulu)
        $histories = [
            ['title' => '10 Life Hacks untuk Mahasiswa yang Sibuk', 'date' => '2024-09-01'],
            ['title' => 'study hacks ala maudy ayunda', 'date' => '2024-08-31'],
            ['title' => 'Panduan Praktis: Hack Menemukan Internship', 'date' => '2024-08-30'],
            ['title' => 'Hack Mengelola Waktu', 'date' => '2024-08-29'],
            ['title' => 'Alasan Utama Motivasi Kamu Hilang', 'date' => '2024-08-28'],
            ['title' => '10 Cara MUDAH Membagi Waktu', 'date' => '2024-08-27'],
            ['title' => 'Life Hack Otak ala Orang Jenius', 'date' => '2024-08-26'],
            ['title' => 'Hack Produktif: Cara Efektif Mengatur Ruang Kerja', 'date' => '2024-08-25'],
        ];

        return view('history.index', compact('histories'));
    }
}
