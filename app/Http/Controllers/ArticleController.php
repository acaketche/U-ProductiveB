<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    }

    // Menampilkan form tambah artikel
    public function create()
    {
        $categories = Category::all(); // Mengambil semua kategori untuk dropdown
        return view('articles.create', compact('categories'));
    }

    // Menyimpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        // Simpan gambar ke direktori 'public/images'
        $imagePath = $request->file('image')->store('images', 'public');

        // Simpan artikel dengan data gambar
        // Article::create([
        //     'title' => $request->title,
        //     'category_id' => $request->category_id,
        //     'content' => $request->content,
        //     'image' => $imagePath,
        //     'user_id' => Auth::id(),
        // ]);
        $article = new Article;
        $article->title = $request->input('title');
        $article->category_id = $request->input('category_id');
        $article->content = $request->input('content');
        $article->image = $imagePath;
        $article->user_id = Auth::id();  // Tambahkan ID pengguna yang sedang login

        $article->save();  // Simpan ke database


        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Menampilkan detail artikel
    public function show($id)
    {
        $article = Article::findOrFail($id);

        // Simpan riwayat ke tabel histories
        History::create([
            'user_id' => auth()->id(),
            'article_id' => $article->id,
            'viewed_at' => now(),
        ]);

        return view('articles.show', compact('article'));
    }

    // Menampilkan form untuk mengedit artikel
    public function edit(Article $article)
    {
        $categories = Category::all(); // Mengambil kategori untuk dropdown saat mengedit
        return view('articles.edit', compact('article', 'categories'));
    }

    // Memperbarui artikel
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,category_id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data gambar jika ada file baru
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $article->update(['image' => $imagePath]);
        }

        // Update data artikel lainnya
        $article->update($request->only('title', 'category_id', 'content'));

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Menampilkan daftar artikel untuk admin
    public function kelolaArtikel()
    {
        $articles = Article::with('category')->paginate(10);
        return view('admin.kelola-artikel', compact('articles'));
    }

    // Menyetujui artikel
    public function approve($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 'approved';
        $article->save();

        return redirect()->route('admin.kelolaArtikel')->with('success', 'Artikel berhasil disetujui!');
    }

    // Menghapus artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('kelola.artikel')->with('success', 'Artikel berhasil dihapus!');
    }
}
