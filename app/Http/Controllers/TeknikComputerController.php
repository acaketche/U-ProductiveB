<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\TeknikComputer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;
use App\Models\History;


class TeknikComputerController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $categories = Category::all();
        $query = TeknikComputer::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter berdasarkan waktu
        if ($request->filled('time')) {
            $now = now();
            if ($request->time === '24 Jam') {
                $query->where('create_at', '>=', $now->subDay());
            } elseif ($request->time === '1 Minggu') {
                $query->where('create_at', '>=', $now->subWeek());
            } elseif ($request->time === '1 Bulan') {
                $query->where('create_at', '>=', $now->subMonth());
            }
        }

        // Ambil data dan pagination
        $teknik_computers = $query->orderBy('create_at','desc')->paginate(6);

        return view('tk.index', compact('teknik_computers', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'file_pdf' => 'required|mimes:pdf|max:2048',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        // Simpan file PDF
        $path = $request->file('file_pdf')->store('file_pdfs', 'public');

        $teknik_computers = new TeknikComputer;
        $teknik_computers->title = $request->input('title');
        $teknik_computers->category_id = $request->input('category_id');
        $teknik_computers->file_pdf = $path;
        $teknik_computers->user_id = Auth::id();

       $teknik_computers->save();

        return redirect()->route('teknik_computer.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $teknik_computers = TeknikComputer::with('user','category')->findOrFail($id);

        // Simpan riwayat ke tabel histories
        History::create([
            'user_id' => auth()->id(),
            'tk_id' => $teknik_computers->tk_id, // Pastikan menggunakan primary key yang benar
            'viewed_at' => now(),
        ]);

        return view('tk.show', compact('teknik_computers'));
    }


    public function edit($id)
    {
        $teknik_computer = TeknikComputer::findOrFail($id);
        $categories = Category::all();
        return view('tk.edit', compact('teknik_computer', 'categories'));
    }

}
