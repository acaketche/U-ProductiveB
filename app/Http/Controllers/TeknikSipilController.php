<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TeknikSipil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use Carbon\Carbon; // Mengimpor Carbon dengan benar

class TeknikSipilController extends Controller
{
    // Menampilkan daftar teknik sipil
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $categories = Category::all();
        $query = TeknikSipil::query();

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

        $teknik_sipils = $query->orderBy('create_at','desc')->paginate(6);


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

    // Simpan file PDF
    $path = $request->file('file_pdf')->store('file_pdfs', 'public');

    $teknik_sipils = new TeknikSipil;
    $teknik_sipils->title = $request->input('title');
    $teknik_sipils->category_id = $request->input('category_id');
    $teknik_sipils->file_pdf = $path;
    $teknik_sipils->user_id = Auth::id();

    $teknik_sipils->save();


    return redirect()->route('teknik_sipil.index')->with('success', 'Data berhasil ditambahkan');
}
    // Menampilkan detail data
    public function show($id)
    {
        $teknik_sipils = TeknikSipil::with('user','category')->findOrFail($id);

        // Simpan riwayat ke tabel histories
        History::create([
            'user_id' => auth()->id(),
            'ts_id' => $teknik_sipils->ts_id, // Pastikan menggunakan primary key yang benar
            'viewed_at' => now(),
        ]);

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
