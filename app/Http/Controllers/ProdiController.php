<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Informatica;
use App\Models\TeknikComputer;
use App\Models\TeknikSipil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;

class ProdiController extends Controller
{
    public function kelolaProdi()
    {
        return view('admin.kelola-prodi');
    }

    public function kelolaInformatika(Request $request)
    {
        $query = Informatica::with(['category', 'user']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('if_id', 'LIKE', "%{$search}%")
                  ->orWhere('user_id', 'LIKE', "%{$search}%");
                  // Search within the related category's name
        $q->orWhereHas('category', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        });
            });
        }


        // Filter by date range
        if ($request->filled(['start_date', 'end_date'])) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('create_at', [$start, $end]);
        }

        // Export PDF
        if ($request->has('export')) {
            return $this->exportIfPDF($query->get());
        }

        // Pagination with query parameters
        $informatics = $query->orderBy('if_id', 'desc')->paginate(5)->withQueryString();

        return view('admin.prodi.kelola-informatika', compact('informatics'));
    }

    private function exportIfPDF($informatics)
    {
        // Ensure relations are loaded
        $informatics->load(['user', 'category']);

        $data = [
            'informatics' => $informatics,
            'exported_at' => now()->format('d-m-Y H:i:s')
        ];

        $pdf = PDF::loadView('admin.pdf.informatics', $data);

        $filename = 'informatics-report-' . time() . '.pdf';
        Storage::put('public/temp/' . $filename, $pdf->output());

        return response()->download(storage_path('app/public/temp/' . $filename))
            ->deleteFileAfterSend(true);
    }

    public function destroy($id)
    {
        $informatics = Informatica::findOrFail($id);
        $informatics->delete();

        return redirect()->route('kelola.informatika')->with('success', 'Tugas Akhir berhasil dihapus!');
    }


    //
    //
    //komputer

    public function kelolaKomputer(Request $request)
    {
        $query = TeknikComputer::with(['category', 'user']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('tk_id', 'LIKE', "%{$search}%")
                  ->orWhere('user_id', 'LIKE', "%{$search}%");
                  // Search within the related category's name
        $q->orWhereHas('category', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        });
            });
        }


        // Filter by date range
        if ($request->filled(['start_date', 'end_date'])) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('create_at', [$start, $end]);
        }

        // Export PDF
        if ($request->has('export')) {
            return $this->exportTkPDF($query->get());
        }

        // Pagination with query parameters
        $teknik_computers = $query->orderBy('tk_id', 'desc')->paginate(5)->withQueryString();

        return view('admin.prodi.kelola-komputer', compact('teknik_computers'));
    }

    private function exportTkPDF($teknik_computers)
    {
        // Ensure relations are loaded
        $teknik_computers->load(['user', 'category']);

        $data = [
            'teknik_computers' => $teknik_computers,
            'exported_at' => now()->format('d-m-Y H:i:s')
        ];

        $pdf = PDF::loadView('admin.pdf.computers', $data);

        $filename = 'computers-report-' . time() . '.pdf';
        Storage::put('public/temp/' . $filename, $pdf->output());

        return response()->download(storage_path('app/public/temp/' . $filename))
            ->deleteFileAfterSend(true);
    }

    public function destroytk($id)
    {
        $teknik_computers = TeknikComputer::findOrFail($id);
        $teknik_computers->delete();

        return redirect()->route('kelola.komputer')->with('success', 'Tugas Akhir berhasil dihapus!');
    }



    //
    //
    // sipil

    public function kelolaSipil(Request $request)
    {
        $query = TeknikSipil::with(['category', 'user']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('ts_id', 'LIKE', "%{$search}%")
                  ->orWhere('user_id', 'LIKE', "%{$search}%");
                  // Search within the related category's name
        $q->orWhereHas('category', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        });
            });
        }


        // Filter by date range
        if ($request->filled(['start_date', 'end_date'])) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('create_at', [$start, $end]);
        }

        // Export PDF
        if ($request->has('export')) {
            return $this->exportTsPDF($query->get());
        }

        // Pagination with query parameters
        $teknik_sipils = $query->orderBy('ts_id', 'desc')->paginate(5)->withQueryString();

        return view('admin.prodi.kelola-sipil', compact('teknik_sipils'));
    }

    private function exportTsPDF($teknik_sipils)
    {
        // Ensure relations are loaded
        $teknik_sipils->load(['user', 'category']);

        $data = [
            'teknik_sipils' => $teknik_sipils,
            'exported_at' => now()->format('d-m-Y H:i:s')
        ];

        $pdf = PDF::loadView('admin.pdf.sipils', $data);

        $filename = 'sipils-report-' . time() . '.pdf';
        Storage::put('public/temp/' . $filename, $pdf->output());

        return response()->download(storage_path('app/public/temp/' . $filename))
            ->deleteFileAfterSend(true);
    }

    public function destroyts($id)
    {
        $teknik_sipils = TeknikSipil::findOrFail($id);
        $teknik_sipils->delete();

        return redirect()->route('kelola.sipil')->with('success', 'Tugas Akhir berhasil dihapus!');
    }
}
