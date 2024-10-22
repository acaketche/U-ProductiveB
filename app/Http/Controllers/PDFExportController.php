<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFExportController extends Controller
{
    public function exportPDF()
    {
        // Fetch data to display in PDF (adjust as needed)
        $data = ['title' => 'Exported PDF', 'content' => 'This is the content of the PDF.'];

        // Load the view file and pass the data
        $pdf = PDF::loadView('pdf-template', $data);

        // Return the PDF as a download
        return $pdf->download('exported-file.pdf');
    }
}
