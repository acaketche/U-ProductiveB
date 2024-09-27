<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category_id'); // Perbaiki nama parameter sesuai dengan nama field di form filter
        $time = $request->input('waktu'); // Perbaiki nama parameter sesuai dengan nama field di form filter
        $query = Video::query();

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan kategori
        if ($category) {
            $query->where('category_id', $category);
        }

        // Filter berdasarkan waktu
        if ($time == 'Dalam 24 Jam') {
            $query->where('created_at', '>=', now()->subDay());
        } elseif ($time == '1 Minggu Terakhir') {
            $query->where('created_at', '>=', now()->subWeek());
        } elseif ($time == '1 Bulan Terakhir') {
            $query->where('created_at', '>=', now()->subMonth());
        }

        $videos = $query->paginate(12);

        // Ambil data kategori dari database
        $categories = Category::all();

        // Kirim data ke view
        return view('video.index', compact('videos', 'categories'));
    }

    public function create()
    {
        // Ambil data kategori dari database
        $categories = Category::all(); // Pastikan Anda sudah mengimpor model Category

        // Tampilkan view tambah video dengan data kategori
        return view('video.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category_id' => 'required|integer|exists:categories,category_id',
            'description' => 'nullable|string|max:5000',
        ]);

        // Panggil method extractYouTubeId()
        $videoId = $this->extractYouTubeId($request->url);
        $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : 'path/to/default/thumbnail.jpg';

        $requestData = $request->all();
        $requestData['thumbnail_url'] = $thumbnailUrl;
        $requestData['user_id'] = Auth::id();

        Video::create($requestData);

        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan.');

    }

    public function edit(Video $video)
    {
        return view('video.edit', compact('video'));
    }

    // Method untuk mengupdate video yang ada
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category_id' => 'required|integer|exists:categories,id', // Perbaiki validasi
            'description' => 'nullable|string|max:1000',
        ]);

        $requestData = $request->all();
        $requestData['user_id'] = auth()->id(); // Menambahkan user_id dari user yang login

        $video->update($requestData);

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function show($id)
    {
        $video = Video::findOrFail($id); // Mengambil data video berdasarkan ID
        $video_Id = $this->extractYouTubeId($video->url); // Mendapatkan ID YouTube dari

         // Simpan riwayat ke tabel histories
    History::create([
        'user_id' => auth()->id(),
        'video_id' => $video->video_id,
        'viewed_at' => now(),
    ]);

        return view('video.show', compact('video', 'video_Id')); // Mengirimkan data video dan video_Id ke view
    }

    // Method untuk mengekstrak ID YouTube dari URL
    private function extractYouTubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
        return $matches[1] ?? null; // Return ID atau null jika tidak ditemukan
    }
    public function kelolaVideo()
        {
            $videos = Video::with('category')->paginate(10);
            return view('admin.kelola-video', compact('videos'));
        }

    public function approve($id)
      {
          $video = Video::findOrFail($id);
          $video->status = 'approved';
          $video->save();

          return redirect()->route('kelola.video')->with('success', 'Video berhasil disetujui!');
      }

    // Menghapus artikel
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->route('kelola.video')->with('success', 'Video berhasil dihapus!');
    }
}
