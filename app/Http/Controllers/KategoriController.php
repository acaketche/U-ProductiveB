<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Prodi;
use PDF;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function kelolaKategori(Request $request)
{
    $query = Category::with('prodi');

    // Search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('name', 'LIKE', "%{$search}%");
    }


    // Export PDF
    if ($request->has('export')) {
        return $this->exportPDF($query->get());
    }

    // Pagination with query parameters
    $categories = $query->paginate(10)->withQueryString();
    $prodis = Prodi::all(); // assuming Prodi is the model for Prodi

    return view('admin.kelola-kategori', compact('categories', 'prodis'));
}

private function exportPDF($categories)
{
    $pdf = PDF::loadView('admin.pdf.categories', compact('categories'));
    $filename = 'categories-report-' . time() . '.pdf';
    Storage::put('public/temp/' . $filename, $pdf->output());
    return response()->download(storage_path('app/public/temp/' . $filename))
        ->deleteFileAfterSend(true);
}



public function create()
{
    $prodis = Prodi::all(); // Get all prodi options
    return view('admin.tambah-kategori', compact('prodis'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'prodi_id' => 'nullable|exists:prodis,prodi_id', // Validate that prodi_id is nullable and exists in the prodis table
    ]);

    Category::create([
        'name' => $request->name,
        'prodi_id' => $request->prodi_id, // Save prodi_id if provided
    ]);

    return redirect()->route('kelola.kategori')->with('success', 'Kategori berhasil ditambahkan.');
}

public function destroy($id)
{
    $categories = Category::findOrFail($id);
    $categories->delete();

    return redirect()->route('kelola.kategori')->with('success', 'Kategori berhasil dihapus!');
}
}
