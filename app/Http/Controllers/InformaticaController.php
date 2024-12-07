<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Informatica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use Carbon\Carbon; // Mengimpor Carbon dengan benar

class InformaticaController extends Controller
{
    // Menampilkan daftar teknik sipil
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $categories = Category::all();
        $query = Informatica::query();

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

        $informatics = $query->orderBy('create_at','desc')->paginate(6);


        return view('informatics.index', compact('informatics', 'categories'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        $categories = Category::all();

        return view('informatics.create', compact('categories'));
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

    $informatics = new Informatica;
    $informatics->title = $request->input('title');
    $informatics->category_id = $request->input('category_id');
    $informatics->file_pdf = $path;
    $informatics->user_id = Auth::id();

    $informatics->save();


    return redirect()->route('informatica.index')->with('success', 'Data berhasil ditambahkan');
}
    // Menampilkan detail data
    public function show($id)
    {
        $informatics = Informatica::with('user','category')->findOrFail($id);

        // Simpan riwayat ke tabel histories
        History::create([
            'user_id' => auth()->id(),
            'if_id' => $informatics->if_id, // Pastikan menggunakan primary key yang benar
            'viewed_at' => now(),
        ]);

        return view('informatics.show', compact('informatics'));
    }

    // Menampilkan form untuk edit data
    public function edit($id)
    {
        $informatics = Informatica::findOrFail($id);
        $categories = Category::all();
        return view('informatics.edit', compact('informatics', 'categories'));
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

        $informatics = Informatica::findOrFail($id);

        // Update gambar jika ada
        if ($request->hasFile('thumbnail_path')) {
            if ($informatics->thumbnail_path) {
                Storage::delete($informatics->thumbnail_path);
            }

            $path = $request->file('thumbnail_path')->store('public/images');
            $validatedData['thumbnail_path'] = $path;
        }

        $informatics->update($validatedData);

        return redirect()->route('informatica.index')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data
    public function destroy($id)
    {
        $informatics = Informatica::findOrFail($id);

        if ($informatics->thumbnail_path) {
            Storage::delete($informatics->thumbnail_path);
        }

        $informatics->delete();

        return redirect()->route('informatica.index')->with('success', 'Data berhasil dihapus');
    }

}
