<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TeknikSipil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class TeknikSipilController extends Controller
{
    // Menampilkan daftar teknik sipil
    public function index(Request $request)
    {
        // Mendapatkan filter pencarian dan kategori
        $search = $request->input('search');
        $category = $request->input('category');
        $time = $request->input('time');

        // Query dasar
        $query = TeknikSipil::query();

        // Filter pencarian
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
        }

        // Filter kategori
        if ($category) {
            $query->where('category_id', $category);
        }

        // Filter waktu
        if ($time) {
            $now = now();
            if ($time === '24 Jam') {
                $query->where('created_at', '>=', $now->subDay());
            } elseif ($time === '1 Minggu') {
                $query->where('created_at', '>=', $now->subWeek());
            } elseif ($time === '1 Bulan') {
                $query->where('created_at', '>=', $now->subMonth());
            }
        }

        // Pagination dan ambil data
        $teknik_sipils = $query->paginate(9);

        // Ambil data kategori
        $categories = Category::all();

        return view('ts.index', compact('teknik_sipils', 'categories'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        $categories = Category::all();

        return view('ts.create', compact('categories'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'file_pdf' => 'required|mimes:pdf|max:2048',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        // Simpan file PDF ke folder storage/app/public/pdfs
        $pdfPath = $request->file('file_pdf')->store('pdfs', 'public');

        $teknik_sipils = new TeknikSipil;
        $teknik_sipils->title = $request->input('title');
        $teknik_sipils->category_id = $request->input('category_id');
        $teknik_sipils->file_pdf = $path;
        $teknik_sipils->user_id = Auth::id();  // Tambahkan ID pengguna yang sedang login
        // $article->status = 'rejected';  // Set status artikel ke 'pending' atau 'waiting for approval'

        // Simpan informatica ke database
        $teknik_sipils->save();
        return redirect()->route('teknik_sipil.index')->with('success', 'Data berhasil ditambahkan');
    }


    // Menampilkan detail data
    public function show($id)
    {
        $teknik_sipils = TeknikSipil::findOrFail($id);
        return view('ts.show', compact('teknik_sipils'));
    }

    // Menampilkan form untuk edit data
    public function edit($id)
    {
        $teknik_sipil = TeknikSipil::findOrFail($id);
        $categories = Category::all();
        return view('ts.edit', compact('teknik_sipil', 'categories'));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail_path' => 'nullable|image',
        ]);

        $teknik_sipil = TeknikSipil::findOrFail($id);

        // Update gambar jika ada
        if ($request->hasFile('thumbnail_path')) {
            if ($teknik_sipil->thumbnail_path) {
                Storage::delete($teknik_sipil->thumbnail_path);
            }

            $path = $request->file('thumbnail_path')->store('public/images');
            $validatedData['thumbnail_path'] = $path;
        }

        $teknik_sipil->update($validatedData);

        return redirect()->route('teknik_sipil.index')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data
    public function destroy($id)
    {
        $teknik_sipil = TeknikSipil::findOrFail($id);

        if ($teknik_sipil->thumbnail_path) {
            Storage::delete($teknik_sipil->thumbnail_path);
        }

        $teknik_sipil->delete();

        return redirect()->route('teknik_sipil.index')->with('success', 'Data berhasil dihapus');
    }

}
