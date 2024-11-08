<?php

namespace App\Http\Controllers;

use App\Models\Informatica; // Pastikan sudah include model Informatica
use App\Models\Category;
use App\Models\History;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class InformaticaController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::all();

    $query = Informatica::query();

    // Filter pencarian
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filter berdasarkan kategori
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Filter berdasarkan waktu
    if ($request->filled('time')) {
        if ($request->time === '24 Jam') {
            $query->where('create_at', '>=', now()->subDay());
        } elseif ($request->time === '1 Minggu') {
            $query->where('create_at', '>=', now()->subWeek());
        } elseif ($request->time === '1 Bulan') {
            $query->where('create_at', '>=', now()->subMonth());
        }
    }

    // Urutkan berdasarkan created_at (waktu pembuatan) secara descending (terbaru di atas)
    $informatics = $query->orderBy('create_at', 'desc')->paginate(6);

    return view('informatics.index', compact('informatics', 'categories'));
}


    public function show($id)
    {
        $informatics = Informatica::with('user', 'category')->findOrFail($id);

        // Simpan riwayat ke tabel histories
        History::create([
            'user_id' => auth()->id(),
            'if_id' => $informatics->if_id, // Pastikan menggunakan primary key yang benar
            'viewed_at' => now(),
        ]);

        return view('informatics.show', compact('informatics'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('informatics.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file_pdf' => 'required|mimes:pdf|max:2048',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        // Simpan file PDF ke folder file_pdfs di storage/public
        $path = $request->file('file_pdf')->store('file_pdfs', 'public');

        // Inisialisasi instance baru dari model Informatica
        $informatics = new Informatica;
        $informatics->title = $request->input('title');
        $informatics->category_id = $request->input('category_id');
        $informatics->file_pdf = $path;
        $informatics->user_id = Auth::id();  // Tambahkan ID pengguna yang sedang login
        // $article->status = 'rejected';  // Set status artikel ke 'pending' atau 'waiting for approval'

        // Simpan informatica ke database
        $informatics->save();

        // Simpan informasi ke database
        // Informatica::create([
        //     'title' => $request->title,
        //     'file_pdf' => $path,
        //     'category_id' => $request->category_id,
        //     'user_id' => Auth::id(), // Menyimpan ID pengguna yang login
        // ]);

        return redirect()->route('informatica.index')->with('success', 'Informatica item added successfully.');
    }

}
