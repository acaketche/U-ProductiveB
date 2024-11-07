<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('Accessed videos.index');
        $search = $request->input('search');
        $time = $request->input('time');

        $query = Video::query();

        $query->where('status', 'approved');

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($time == '24 Jam') {
            $query->where('created_at', '>=', now()->subDay());
        } elseif ($time == '1 Minggu') {
            $query->where('created_at', '>=', now()->subWeek());
        } elseif ($time == '1 Bulan') {
            $query->where('created_at', '>=', now()->subMonth());
        }

        $query->orderBy('created_at', 'desc');
        $videos = $query->paginate(8);

        $categories = Category::all();

        return view('video.index', compact('videos', 'categories'));
    }

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    public function create()
    {
        $categories = Category::all();
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

        $videoId = $this->extractYouTubeId($request->url);
        $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : 'path/to/default/thumbnail.jpg';

        $requestData = $request->all();
        $requestData['thumbnail_url'] = $thumbnailUrl;
        $requestData['user_id'] = Auth::id();
        $requestData['status'] = 'rejected';

        Video::create($requestData);

        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('video.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category_id' => 'required|integer|exists:categories,category_id',
            'description' => 'nullable|string|max:5000',
        ]);

        $requestData = $request->all();
        $requestData['user_id'] = auth()->id(); // Menambahkan user_id dari user yang login

        $video->update($requestData);

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function show($id)
    {
        $video = Video::findOrFail($id); // Mengambil data video berdasarkan ID
        $videoId = $this->extractYouTubeId($video->url); // Mendapatkan ID YouTube dari

         // Simpan riwayat ke tabel histories
         History::create([
            'user_id' => auth()->id(),
            'video_id' => $id,
            'viewed_at' => now(),
        ]);

        return view('video.show', compact('video', 'videoId')); // Mengirimkan data video dan video_Id ke view
    }

    private function exportVideoPDF($videos)
    {
        $videos->load(['user', 'category']);

        $data = [
            'videos' => $videos,
            'exported_at' => now()->format('d-m-Y H:i:s')
        ];

        $pdf = PDF::loadView('admin.pdf.videos', $data);

        $filename = 'videos-report-' . time() . '.pdf';
        Storage::put('public/temp/' . $filename, $pdf->output());

        return response()->download(storage_path('app/public/temp/' . $filename))
            ->deleteFileAfterSend(true);
    }

    public function kelolaVideo(Request $request)
    {
        $query = Video::with(['category', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('video_id', 'LIKE', "%{$search}%")
                    ->orWhere('user_id', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled(['start_date', 'end_date'])) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('export')) {
            return $this->exportVideoPDF($query->get());
        }

        $videos = $query->latest()->paginate(4)->withQueryString();

        return view('admin.kelola-video', compact('videos'));
    }

    public function approve($id)
    {
        $video = Video::findOrFail($id);
        $video->status = 'approved';
        $video->save();

        return redirect()->route('kelola.video')->with('success', 'Video berhasil disetujui!');
    }

    public function reject($id)
    {
        $video = Video::findOrFail($id);
        $video->status = 'rejected';
        $video->save();

        return redirect()->route('kelola.video')->with('success', 'Video berhasil ditolak!');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('kelola.video')->with('success', 'Video berhasil dihapus!');
    }

    private function extractYouTubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
        return $matches[1] ?? null;
    }
}
