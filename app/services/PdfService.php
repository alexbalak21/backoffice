<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class PdfService
{
    protected $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');
        
        $this->dompdf = new Dompdf($options);
    }

    /**
     * Generate PDF from view
     *
     * @param string $viewName
     * @param array $data
     * @param string $filename
     * @param string $paperSize (default: 'A4')
     * @param string $orientation (default: 'portrait')
     * @return \Dompdf\Dompdf
     */
    public function generatePdf($viewName, $data = [], $filename = 'document.pdf', $paperSize = 'A4', $orientation = 'portrait')
    {
        // Render the view
        $html = View::make($viewName, $data)->render();
        
        // Load HTML to Dompdf
        $this->dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $this->dompdf->setPaper($paperSize, $orientation);
        
        // Render the HTML as PDF
        $this->dompdf->render();
        
        // Set the filename for download
        $this->dompdf->stream($filename);
        
        return $this->dompdf;
    }

    /**
     * Save PDF to storage
     *
     * @param string $path
     * @param string $filename
     * @return string
     */
    public function savePdf($path = 'pdf', $filename = null)
    {
        $filename = $filename ?? 'document_' . now()->format('Ymd_His') . '.pdf';
        $fullPath = storage_path("app/public/{$path}/{$filename}");
        
        // Create directory if it doesn't exist
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }
        
        // Save the PDF
        file_put_contents($fullPath, $this->dompdf->output());
        
        return "storage/{$path}/{$filename}";
    }
}
