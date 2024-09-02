<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class KategoriController extends Controller
{
    public function kelolaKategori()
        {
            {
                $categories = Category::all();
                return view('admin.kelola-kategori', compact('categories'));
            }
        }
        public function create()
{
    return view('admin.tambah-kategori');
}

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            Category::create([
                'name' => $request->name,
            ]);

            return redirect()->route('kelola.kategori')->with('success', 'Kategori berhasil ditambahkan.');
        }
        public function destroy($id)
        {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('kelola.kategori')->with('success', 'Kategori berhasil dihapus.');
        }
}
