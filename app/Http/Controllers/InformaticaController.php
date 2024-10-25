<?php

namespace App\Http\Controllers;

use App\Models\Informatica; // Pastikan sudah include model Informatica
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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

        // Simpan file PDF ke folder file_pdfs di storage/public
        $path = $request->file('file_pdf')->store('file_pdfs', 'public');

        // Simpan informasi ke database

        Informatica::create([
            'title' => $request->title,
            'file_pdf' => $path, // Simpan path file PDF
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('informatica.index')->with('success', 'Informatica item added successfully.');
    }


    // Method untuk membuat thumbnail PDF
    private function generateThumbnail($path)
    {
        $thumbnailPath = 'thumbnails/' . basename($path, '.pdf') . '.jpg';

        if (!Storage::exists($thumbnailPath)) {
            $pdfFullPath = storage_path('public/storage/' . $path);

            $imagick = new \Imagick();
            $imagick->setResolution(300, 300);
            $imagick->readImage($pdfFullPath . '[0]');
            $imageData = $imagick->getImageBlob();
            $imagick->clear();
            $imagick->destroy();

            $image = Image::make($imageData);
            $image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save(storage_path('public/storage/' . $thumbnailPath));
        }

        return $thumbnailPath;
    }

    public function moveFile($path)
    {
        // Memeriksa apakah file ada di storage/app/public/file_pdfs
        if (Storage::disk('public')->exists('file_pdfs/' . $path)) {
            // Memindahkan file dari storage/app/public/file_pdfs ke public/storage/file_pdfs
            Storage::disk('public')->move('file_pdfs/' . $path, 'file_pdfs/' . $path);

            return response()->json(['message' => 'File berhasil dipindahkan'], 200);
        }

        return response()->json(['message' => 'File tidak ditemukan'], 404);
    }

}

