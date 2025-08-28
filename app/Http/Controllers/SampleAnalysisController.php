<?php

namespace App\Http\Controllers;

use App\Models\SampleAnalysis;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SampleAnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sampleAnalyses = SampleAnalysis::latest()->paginate(10);
        return view('sample-analyses.index', compact('sampleAnalyses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sample-analyses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client' => 'nullable|string|max:255',
            'sampling_date' => 'nullable|date',
            'sampling_location' => 'nullable|string|max:255',
            'lab_receipt_datetime' => 'nullable|date',
            'receipt_temperature' => 'nullable|numeric',
            'storage_conditions' => 'nullable|string',
            'analysis_date' => 'nullable|date',
            'supplier_manufacturer' => 'nullable|string|max:255',
            'packaging' => 'nullable|string|max:255',
            'approval_number' => 'nullable|string|max:255',
            'batch_number' => 'nullable|string|max:255',
            'fishing_type' => 'nullable|string|max:255',
            'product_name' => 'nullable|string|max:255',
            'species' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'packaging_date' => 'nullable|date',
            'best_before_date' => 'nullable|date',
            'imp' => 'nullable|string|max:50',
            'hx' => 'nullable|string|max:50',
            'nucleotide_note' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            
            SampleAnalysis::create($validated);
            
            DB::commit();
            
            return redirect()->route('sample-analyses.index')
                ->with('success', 'Sample analysis created successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error creating sample analysis: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SampleAnalysis $sampleAnalysis)
    {
        return view('sample-analyses.show', compact('sampleAnalysis'));
    }

    public function analysisTable()
    {
        return view('sample-analyses.analysis-table');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SampleAnalysis $sampleAnalysis)
    {
        return view('sample-analyses.edit', compact('sampleAnalysis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SampleAnalysis $sampleAnalysis)
    {
        $validated = $request->validate([
            'client' => 'nullable|string|max:255',
            'sampling_date' => 'nullable|date',
            'sampling_location' => 'nullable|string|max:255',
            'lab_receipt_datetime' => 'nullable|date',
            'receipt_temperature' => 'nullable|numeric',
            'storage_conditions' => 'nullable|string',
            'analysis_date' => 'nullable|date',
            'supplier_manufacturer' => 'nullable|string|max:255',
            'packaging' => 'nullable|string|max:255',
            'approval_number' => 'nullable|string|max:255',
            'batch_number' => 'nullable|string|max:255',
            'fishing_type' => 'nullable|string|max:255',
            'product_name' => 'nullable|string|max:255',
            'species' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'packaging_date' => 'nullable|date',
            'best_before_date' => 'nullable|date',
            'imp' => 'nullable|string|max:50',
            'hx' => 'nullable|string|max:50',
            'nucleotide_note' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            
            $sampleAnalysis->update($validated);
            
            DB::commit();
            
            return redirect()->route('sample-analyses.show', $sampleAnalysis)
                ->with('success', 'Sample analysis updated successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error updating sample analysis: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SampleAnalysis $sampleAnalysis)
    {
        try {
            $sampleAnalysis->delete();
            return redirect()->route('sample-analyses.index')
                ->with('success', 'Sample analysis deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting sample analysis: ' . $e->getMessage());
        }
    }

    /**
     * Clone the specified resource.
     */
    public function clone(SampleAnalysis $sampleAnalysis)
    {
        // Get all the attributes from the original
        $attributes = $sampleAnalysis->getAttributes();
        
        // Remove the primary key and any timestamps
        unset($attributes['id'], $attributes['created_at'], $attributes['updated_at']);
        
        // Add a note to the batch number to indicate it's a copy
        if (isset($attributes['batch_number'])) {
            $attributes['batch_number'] = $attributes['batch_number'] . ' (Copy)';
        }
        
        // Store the attributes in the session to pre-fill the form
        return redirect()->route('sample-analyses.create')
            ->with('old', $attributes)
            ->with('success', 'Please review and save the copied analysis.');
    }

    /**
     * Export analysis to PDF
     *
     * @param  \App\Models\SampleAnalysis  $sampleAnalysis
     * @return \Illuminate\Http\Response
     */
    public function exportPdf(SampleAnalysis $sampleAnalysis)
    {
        // Get the HTML content directly from the template file
        $templatePath = resource_path('pdf/templates/modele_rapport.blade.php');
        $html = view()->file($templatePath, [
            'analysis' => $sampleAnalysis,
            'refNumber' => 'NOVOCIB-' . $sampleAnalysis->id . '-' . date('Ymd'),
            'analysisDate' => $sampleAnalysis->analysis_date ? \Carbon\Carbon::parse($sampleAnalysis->analysis_date)->format('d/m/Y') : 'N/A',
            'samplingDate' => $sampleAnalysis->sampling_date ? \Carbon\Carbon::parse($sampleAnalysis->sampling_date)->format('d/m/Y') : 'N/A',
            'labReceiptDate' => $sampleAnalysis->lab_receipt_datetime ? \Carbon\Carbon::parse($sampleAnalysis->lab_receipt_datetime)->format('d/m/Y H:i') : 'N/A',
            'packagingDate' => $sampleAnalysis->packaging_date ? \Carbon\Carbon::parse($sampleAnalysis->packaging_date)->format('d/m/Y') : 'N/A',
            'bestBeforeDate' => $sampleAnalysis->best_before_date ? \Carbon\Carbon::parse($sampleAnalysis->best_before_date)->format('d/m/Y') : 'N/A',
            'nucleotideNotes' => !empty($sampleAnalysis->nucleotide_note) ? explode("\n", $sampleAnalysis->nucleotide_note) : []
        ])->render();
        
        // Use the DomPDF facade
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $filename = 'analysis_' . $sampleAnalysis->id . '_' . now()->format('Ymd_His') . '.pdf';
        
        // Display the PDF in the browser
        return $dompdf->stream($filename, [
            'Attachment' => false, // Set to false to display in browser
            'isRemoteEnabled' => true // Enable remote images if needed
        ]);
    }

    /**
     * Show the JSON import form
     */
    public function showImportForm()
    {
        \Log::info('showImportForm method called');
        if (view()->exists('sample-analyses.import_json')) {
            return view('sample-analyses.import_json');
        }
        \Log::error('View not found: sample-analyses.import_json');
        abort(404, 'The import view could not be found.');
    }

    /**
     * Process JSON import
     */
    public function importJson(Request $request)
    {
        $request->validate([
            'json' => 'required|string'
        ]);

        try {
            // Get the raw JSON string
            $jsonString = $request->input('json');
            
            // Clean the JSON string
            $jsonString = stripslashes($jsonString);
            $jsonString = trim($jsonString, '\"');
            
            // Decode the JSON string
            $data = json_decode($jsonString, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format: ' . json_last_error_msg());
            }

            // If the input is a single object, convert it to an array with one item
            if (!is_array($data) || (isset($data[0]) === false && !empty($data))) {
                $data = [$data];
            } elseif (empty($data)) {
                throw new \Exception('No valid data found in the JSON');
            }

            $imported = 0;
            $errors = [];
            
            foreach ($data as $index => $item) {
                try {
                    if (is_array($item) && !empty($item)) {
                        $this->importAnalysis($item);
                        $imported++;
                    }
                } catch (\Exception $e) {
                    $errors[] = "Row " . ($index + 1) . ": " . $e->getMessage();
                }
            }

            $message = "Successfully imported {$imported} records.";
            if (!empty($errors)) {
                $message .= ' ' . count($errors) . ' records failed to import.';
                return back()->with('warning', $message)->with('errors', $errors);
            }

            return redirect()->route('sample-analyses.index')
                ->with('success', $message);
                
        } catch (\Exception $e) {
            return back()->with('error', 'Error importing data: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Import a single analysis
     */
    protected function importAnalysis($data)
    {
        // Validate required fields
        $validator = Validator::make($data, [
            'client' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'batch_number' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new \Exception(implode(' ', $validator->errors()->all()));
        }

        // Map and prepare the data
        $mappedData = [
            'client' => $data['client'] ?? null,
            'product_name' => $data['product_name'] ?? null,
            'batch_number' => $data['batch_number'] ?? null,
            'sampling_date' => $data['sampling_date'] ?? null,
            'sampling_location' => $data['sampling_location'] ?? null,
            'lab_receipt_datetime' => $data['lab_receipt_datetime'] ?? null,
            'receipt_temperature' => $data['receipt_temperature'] ?? null,
            'storage_conditions' => $data['storage_conditions'] ?? null,
            'analysis_date' => $data['analysis_date'] ?? null,
            'supplier_manufacturer' => $data['supplier_manufacturer'] ?? null,
            'packaging' => $data['packaging'] ?? null,
            'approval_number' => $data['approval_number'] ?? null,
            'fishing_type' => $data['fishing_type'] ?? null,
            'species' => $data['species'] ?? null,
            'origin' => $data['origin'] ?? null,
            'packaging_date' => $data['packaging_date'] ?? null,
            'best_before_date' => $data['best_before_date'] ?? null,
            'imp' => $data['imp'] ?? null,
            'hx' => $data['hx'] ?? null,
            'nucleotide_note' => $data['nucleotide_note'] ?? null,
        ];

        // Create the analysis
        SampleAnalysis::create($mappedData);
    }
}
