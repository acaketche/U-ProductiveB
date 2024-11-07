<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Informatica;
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
}
