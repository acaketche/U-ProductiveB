<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    // Menampilkan daftar artikel
    public function index(Request $request)
{
    \Log::info('Accessed articles.index');
    // Ambil nilai pencarian, kategori, dan waktu
    $search = $request->input('search');
    $time = $request->input('time');

    // Mulai query
    $query = Article::query();

    $query->where('status', 'approved')
    ->where('is_active', true);

    // Filter berdasarkan pencarian
    if ($search) {
        $query->where('title', 'like', '%' . $search . '%');
    }

    // Filter berdasarkan kategori
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->input('category_id'));
    }

    // Filter berdasarkan waktu
    if ($time == '24 Jam') {
        $query->where('created_at', '>=', now()->subDay());
    } elseif ($time == '1 Minggu') {
        $query->where('created_at', '>=', now()->subWeek());
    } elseif ($time == '1 Bulan') {
        $query->where('created_at', '>=', now()->subMonth());
    }

    // Urutkan berdasarkan artikel terbaru
    $query->orderBy('created_at', 'desc');

    // Ambil hasil dengan pagination
    $articles = $query->paginate(6);

    // Ambil data kategori dari database
    $categories = Category::all();

    // Kirim data ke view
    return view('articles.index', compact('articles', 'categories'));
}


    public function __construct()
{
    // Tambahkan middleware auth untuk method tertentu
    $this->middleware('auth')->only(['create', 'store']);
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
    // Validasi input
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,category_id',
        'content' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Simpan gambar ke direktori 'public/images'
    $imagePath = $request->file('image')->store('images', 'public');

    // Inisialisasi instance baru dari model Article
    $article = new Article;
    $article->title = $request->input('title');
    $article->category_id = $request->input('category_id');
    $article->content = $request->input('content');
    $article->image = $imagePath;
    $article->user_id = Auth::id();  // Tambahkan ID pengguna yang sedang login
    $article->status = 'pending';  // Set status artikel ke 'pending' atau 'waiting for approval'

    // Simpan artikel ke database
    $article->save();

    // Redirect setelah berhasil menambahkan artikel
    return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan!');
}


    // Menampilkan detail artikel
    public function show($id)
    {
        // Mengambil artikel dengan user dan category menggunakan eager loading
        $article = Article::with('user', 'category')->findOrFail($id);

        // Simpan riwayat ke tabel histories
        History::create([
            'user_id' => auth()->id(),
            'article_id' => $article->article_id, // Pastikan menggunakan primary key yang benar
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
    private function exportArticlePDF($articles)
{
    // Memastikan relasi di-load
    $articles->load(['user', 'category']);

    $data = [
        'articles' => $articles,
        'exported_at' => now()->format('d-m-Y H:i:s')
    ];

    $pdf = PDF::loadView('admin.pdf.articles', $data);

    $filename = 'articles-report-' . time() . '.pdf';
    Storage::put('public/temp/' . $filename, $pdf->output());

    return response()->download(storage_path('app/public/temp/' . $filename))
        ->deleteFileAfterSend(true);
}

public function kelolaArtikel(Request $request)
{
    $query = Article::with(['category', 'user']);

    // Search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('article_id', 'LIKE', "%{$search}%")
              ->orWhere('user_id', 'LIKE', "%{$search}%");
        });
    }

    // Filter by date range
    if ($request->filled(['start_date', 'end_date'])) {
        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();
        $query->whereBetween('created_at', [$start, $end]);
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Export PDF
    if ($request->has('export')) {
        return $this->exportArticlePDF($query->get());
    }

    // Pagination dengan query parameters
    $articles = $query->latest()->paginate(10)->withQueryString();

    return view('admin.kelola-artikel', compact('articles'));
}

    // Menyetujui artikel
    public function approve($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 'approved';
        $article->save();

        return redirect()->route('kelola.artikel')->with('success', 'Artikel berhasil disetujui!');
    }
    public function reject($id)
        {
            $article = Article::findOrFail($id);
            $article->status = 'rejected';
            $article->save();

            return redirect()->route('kelola.artikel')->with('success', 'Artikel berhasil ditolak!');
        }


    // Menghapus artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('kelola.artikel')->with('success', 'Artikel berhasil dihapus!');
    }

    public function stopArticle($id)
{
    $article = Article::findOrFail($id);

    // Pastikan hanya artikel yang sudah diapprove yang bisa di-stop
    if ($article->status == 'approved') {
        $article->is_active = false;
        $article->save();

        return redirect()->route('kelola.artikel')->with('success', 'Artikel berhasil dihentikan sementara!');
    }

    return redirect()->route('kelola.artikel')->with('error', 'Artikel tidak dapat dihentikan!');
}

public function startArticle($id)
{
    $article = Article::findOrFail($id);

    // Pastikan hanya artikel yang sudah diapprove yang bisa di-start
    if ($article->status == 'approved') {
        $article->is_active = true;
        $article->save();

        return redirect()->route('kelola.artikel')->with('success', 'Artikel berhasil ditayangkan kembali!');
    }

    return redirect()->route('kelola.artikel')->with('error', 'Artikel tidak dapat ditayangkan!');
}

public function showkelolaartikel($id)
{
    // Mengambil artikel dengan user dan category menggunakan eager loading
    $article = Article::with('user', 'category')->findOrFail($id);

    // Simpan riwayat ke tabel histories
    History::create([
        'user_id' => auth()->id(),
        'article_id' => $article->article_id, // Pastikan menggunakan primary key yang benar
        'viewed_at' => now(),
    ]);

    return view('admin.show-artikel', compact('article'));
}
}
