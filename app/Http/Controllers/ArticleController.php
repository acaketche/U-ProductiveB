<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;

class ArticleController extends Controller
{
    // Menampilkan daftar artikel
    public function index(Request $request)
{
    // Ambil nilai pencarian, kategori, dan waktu
    $search = $request->input('search');
    $category = $request->input('category');
    $time = $request->input('time');

    // Mulai query
    $query = Article::query();

    // Filter berdasarkan pencarian
    if ($search) {
        $query->where('title', 'like', '%' . $search . '%');
    }

    // Filter berdasarkan kategori
    if ($category) {
        $query->where('category_id', $category);
    }

    // Filter berdasarkan waktu (contoh sederhana)
    if ($time == '24 Jam') {
        $query->where('created_at', '>=', now()->subDay());
    } elseif ($time == '1 Minggu') {
        $query->where('created_at', '>=', now()->subWeek());
    } elseif ($time == '1 Bulan') {
        $query->where('created_at', '>=', now()->subMonth());
    }

    // Ambil hasil dengan pagination
    $articles = $query->paginate(10);

    // Ambil data kategori dari database
    $categories = Category::all();

    // Kirim data ke view
    return view('articles.index', compact('articles', 'categories'));

        // Filter berdasarkan waktu (contoh sederhana)
        if ($time == '24 Jam') {
            $query->where('created_at', '>=', now()->subDay());
        } elseif ($time == '1 Minggu') {
            $query->where('created_at', '>=', now()->subWeek());
        } elseif ($time == '1 Bulan') {
            $query->where('created_at', '>=', now()->subMonth());
        }

        // // Ambil hasil dengan pagination
        $articles = $query->paginate(10);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all(); // Mengambil semua kategori untuk dropdown
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar ke direktori 'public/images'

        Article::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'image' => $imagePath, // Simpan path gambar
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Menampilkan detail artikel
    public function show($article_id)
{
    $article = Article::findOrFail($article_id);
    return view('articles.show', compact('article'));
}

    // Menampilkan form untuk mengedit artikel
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

      // Memperbarui artikel
      public function update(Request $request, Article $article)
      {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,category_id', // Pastikan ID kategori ada di tabel categories
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

          if ($request->hasFile('image')) {
              $validatedData['image'] = $request->file('image')->store('uploads', 'public');
          }

          $article->update($validatedData);

          return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
      }

    // Menghapus artikel
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
