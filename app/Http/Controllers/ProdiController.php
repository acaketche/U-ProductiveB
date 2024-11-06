<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::all();
        return view('prodi.index', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodiOptions = Prodi::getProdiOptions();
        return view('prodi.create', compact('prodiOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prodi_id' => ['required', 'string', 'in:' . implode(',', Prodi::getProdiOptions())],
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle PDF upload
        if ($request->hasFile('file_pdf')) {
            $pdfPath = $request->file('file_pdf')->store('pdfs', 'public');
            $data['file_pdf'] = $pdfPath;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        // Set user_id dari auth user jika diperlukan
        $data['user_id'] = auth()->id();

        Prodi::create($data);

        return redirect()->route('prodi.index')
            ->with('success', 'Prodi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($prodi_id)
    {
        // Validate prodi_id
        if (!in_array($prodi_id, Prodi::getProdiOptions())) {
            abort(404);
        }

        // Get search query
        $search = request('search');

        // Query tugas akhir berdasarkan prodi
        $theses = Prodi::where('prodi_id', $prodi_id)
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('create_at', 'desc')
            ->paginate(10);

        return view('prodi.show', compact('theses', 'prodi_id'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        $prodiOptions = Prodi::getProdiOptions();
        return view('prodi.edit', compact('prodi', 'prodiOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        $validator = Validator::make($request->all(), [
            'prodi_id' => ['required', 'string', 'in:' . implode(',', Prodi::getProdiOptions())],
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle PDF upload
        if ($request->hasFile('file_pdf')) {
            // Delete old file if exists
            if ($prodi->file_pdf) {
                Storage::disk('public')->delete($prodi->file_pdf);
            }
            $pdfPath = $request->file('file_pdf')->store('pdfs', 'public');
            $data['file_pdf'] = $pdfPath;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($prodi->thumbnail) {
                Storage::disk('public')->delete($prodi->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        $prodi->update($data);

        return redirect()->route('prodi.index')
            ->with('success', 'Prodi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        // Delete associated files
        if ($prodi->file_pdf) {
            Storage::disk('public')->delete($prodi->file_pdf);
        }
        if ($prodi->thumbnail) {
            Storage::disk('public')->delete($prodi->thumbnail);
        }

        $prodi->delete();

        return redirect()->route('prodi.index')
            ->with('success', 'Prodi berhasil dihapus');
    }
}
