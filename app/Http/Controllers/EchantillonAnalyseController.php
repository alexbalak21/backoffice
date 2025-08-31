<?php

namespace App\Http\Controllers;

use App\Models\EchantillonAnalyse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EchantillonAnalyseController extends Controller
{
    /**
     * Display the analysis table with all echantillons
     * 
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function analysisTable()
    {
        try {
            // Get fresh data from the database
            $echantillons = EchantillonAnalyse::latest()->get();
            
            // Convert to JSON with pretty print for frontend
            $echantillonsJson = $echantillons->toJson(JSON_PRETTY_PRINT);

            return view('sample-analyses.analysis-table', [
                'echantillons' => $echantillons,
                'echantillonsJson' => $echantillonsJson
            ]);

        } catch (\Exception $e) {
            Log::error('Error in analysisTable: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the analysis table.');
        }
    }

    /**
     * Store newly created echantillons in storage.
     */
    public function store(Request $request)
    {
        // Handle both JSON and form-data requests
        $data = $request->input('analyses');
        
        // If data is a JSON string, decode it
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        if (!is_array($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Format de données invalide',
                'received_data' => $request->all() // For debugging
            ], 400);
        }
        
        try {
            DB::beginTransaction();
            
            $created = [];
            
            foreach ($data as $item) {
                // Only create a record if at least one field has a value
                if (!empty(array_filter($item))) {
                    $created[] = EchantillonAnalyse::create($item);
                }
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => count($created) . ' échantillon(s) enregistré(s) avec succès',
                'data' => $created
            ]);
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'enregistrement des échantillons: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement: ' . $e->getMessage()
            ], 500);
        }
    }
}
