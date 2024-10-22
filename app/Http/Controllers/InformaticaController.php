<?php

namespace App\Http\Controllers;

use App\Models\Informatica; // Pastikan sudah include model Informatica
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
                $query->where('created_at', '>=', now()->subDay());
            } elseif ($request->time === '1 Minggu') {
                $query->where('created_at', '>=', now()->subWeek());
            } elseif ($request->time === '1 Bulan') {
                $query->where('created_at', '>=', now()->subMonth());
            }
        }

        $informatics = $query->paginate(9);

        return view('informatics.index', compact('informatics', 'categories'));
    }

    public function show($id)
    {
        $informatics = Informatica::findOrFail($id);
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

        $path = $request->file('file_pdf')->store('file_pdfs', 'public');

        Informatica::create([
            'title' => $request->title,
            'file_pdf' => $path,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('informatica.index')->with('success', 'Informatica item added successfully.');
    }


    // Method untuk membuat thumbnail PDF
    private function generateThumbnail($path)
    {
        // Path thumbnail
        $thumbnailPath = 'thumbnails/' . basename($path, '.file_pdf') . '.jpg';

        // Buat thumbnail jika belum ada
        if (!\Storage::exists($thumbnailPath)) {
            $pdfFullPath = storage_path('app/public/' . $path);

            // Mengambil halaman pertama dari PDF menggunakan Imagick
            $imagick = new \Imagick();
            $imagick->setResolution(300, 300);
            $imagick->readImage($pdfFullPath . '[0]');
            $imageData = $imagick->getImageBlob();
            $imagick->clear();
            $imagick->destroy();

            // Konversi ke format gambar menggunakan Intervention Image
            $image = Image::make($imageData);
            $image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Simpan thumbnail
            $image->save(storage_path('app/public/' . $thumbnailPath));
        }

        return $thumbnailPath;
    }

}

