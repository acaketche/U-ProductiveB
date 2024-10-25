<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\TeknikComputer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;

class TeknikComputerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $time = $request->input('time');

        // Query dasar
        $query = TeknikComputer::query();

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
        $teknik_computers = $query->paginate(9);

        // Ambil data kategori
        $categories = Category::all();

        return view('tk.index', compact('teknik_computers', 'categories'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        $categories = Category::all();
        return view('tk.create', compact('categories'));
    }

    // Menyimpan data baru
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'title' => 'required|string|max:255',
        'file_pdf' => 'required|mimes:pdf|max:2048',
        'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:3500', // Validasi thumbnail
        'category_id' => 'required|exists:categories,category_id',
    ]);

    // Simpan file PDF ke folder storage/app/public/pdfs
    $pdfPath = $request->file('file_pdf')->store('pdfs', 'public');

    // Simpan thumbnail ke folder storage/app/public/thumbnails
    $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

    // Simpan data ke database
    TeknikComputer::create([
        'title' => $request->title,
        'file_pdf' => $pdfPath,
        'thumbnail_path' => $thumbnailPath,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('teknik_computer.index')->with('success', 'Data berhasil ditambahkan');
}



    // Fungsi untuk menghasilkan thumbnail dari PDF
    public function generateThumbnail($pdfPath)
    {
        $thumbnailName = 'thumbnail_' . Str::random(10) . '.jpg';
        $thumbnailPath = storage_path('app/public/thumbnails/' . $thumbnailName);

        // Membuat direktori thumbnails jika belum ada
        if (!file_exists(storage_path('app/public/thumbnails'))) {
            mkdir(storage_path('app/public/thumbnails'), 0755, true);
        }

        // Jika Imagick tersedia, gunakan untuk membuat thumbnail
        if (extension_loaded('imagick')) {
            try {
                $imagick = new \Imagick();
                $imagick->setResolution(150, 150); // Resolusi thumbnail
                $imagick->readImage($pdfPath . '[0]'); // Halaman pertama PDF
                $imagick->setImageFormat('jpg');
                $imagick->writeImage($thumbnailPath);
                return 'thumbnails/' . $thumbnailName;
            } catch (\Exception $e) {
                // Log error jika perlu
                return null;
            }
        }

        return null;
    }

    // Menampilkan detail data
    public function show($id)
    {
        $teknik_computers = TeknikComputer::findOrFail($id);
        return view('tk.show', compact('teknik_computers'));
    }

    // Menampilkan form untuk edit data
//     public function edit($id)
//     {
//         $teknik_computer = TeknikComputer::findOrFail($id);
//         $categories = Category::all();
//         return view('ts.', compact('teknik_sipil', 'categories'));
//     }

//     // Memperbarui data
//     public function update(Request $request, $id)
// {
//     $validatedData = $request->validate([
//         'title' => 'required|max:255',
//         'content' => 'required',
//         'category_id' => 'required|integer',
//         'thumbnail_path' => 'nullable|image',
//     ]);

//     $teknik_sipil = TeknikSipil::findOrFail($id);

//     // Update gambar jika ada
//     if ($request->hasFile('thumbnail_path')) {
//         if ($teknik_sipil->thumbnail_path) {
//             Storage::delete($teknik_sipil->thumbnail_path);
//         }

//         $path = $request->file('thumbnail_path')->store('public/images');
//         $validatedData['thumbnail_path'] = $path;
//     }

//     $teknik_sipil->update($validatedData);

//     return redirect()->route('teknik_sipil.index')->with('success', 'Data berhasil diperbarui');
// }


//     // Menghapus data
//     public function destroy($id)
// {
//     $teknik_sipil = TeknikSipil::findOrFail($id);

//     if ($teknik_sipil->thumbnail_path) {
//         Storage::delete($teknik_sipil->thumbnail_path);
//     }

//     $teknik_sipil->delete();

//     return redirect()->route('teknik_sipil.index')->with('success', 'Data berhasil dihapus');
// }
}
