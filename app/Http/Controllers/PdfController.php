<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    /**
     * Display a listing of the PDFs.
     */
    public function index()
    {
        $pdfs = Pdf::latest()->paginate(15);
        return view('pdf.index', compact('pdfs'));
    }

    /**
     * Show the form for creating a new PDF.
     */
    public function create()
    {
        return view('pdf.create');
    }

    /**
     * Store a newly created PDF in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client' => 'required|string|max:255',
            'html_content' => 'required|string',
        ]);

        $pdf = Pdf::create([
            'client' => $validated['client'],
            'ref' => 'PDF-' . Str::upper(Str::random(8)),
            'html_content' => $validated['html_content'],
        ]);

        return redirect()->route('pdfs.show', $pdf)
            ->with('success', 'PDF created successfully.');
    }

    /**
     * Display the specified PDF.
     */
    public function show(Pdf $pdf)
    {
        return view('pdf.show', compact('pdf'));
    }

    /**
     * Generate and download the PDF.
     */
    public function download(Pdf $pdf)
    {
        $pdfContent = app('dompdf.wrapper');
        $pdfContent->loadHTML($pdf->html_content);
        
        return $pdfContent->download('document-' . $pdf->ref . '.pdf');
    }

    /**
     * Show the form for editing the specified PDF.
     */
    public function edit(Pdf $pdf)
    {
        return view('pdf.edit', compact('pdf'));
    }

    /**
     * Update the specified PDF in storage.
     */
    public function update(Request $request, Pdf $pdf)
    {
        $validated = $request->validate([
            'client' => 'required|string|max:255',
            'html_content' => 'required|string',
        ]);

        $pdf->update($validated);

        return redirect()->route('pdfs.show', $pdf)
            ->with('success', 'PDF updated successfully.');
    }

    /**
     * Remove the specified PDF from storage.
     */
    public function destroy(Pdf $pdf)
    {
        $pdf->delete();
        
        return redirect()->route('pdfs.index')
            ->with('success', 'PDF deleted successfully.');
    }
}
