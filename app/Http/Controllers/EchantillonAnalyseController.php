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
            $echantillons = EchantillonAnalyse::get();
            
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

    /**
     * Update the specified echantillon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $echantillon = EchantillonAnalyse::findOrFail($id);
            $data = $request->all();
            
            // Log the received data for debugging
            \Log::info('Updating echantillon ' . $id . ' with data:', $data);
            
            // Only update if at least one field has a value
            if (!empty($data) && !empty(array_filter($data))) {
                $updated = $echantillon->update($data);
                
                if ($updated) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Échantillon mis à jour avec succès',
                        'data' => $echantillon->fresh()
                    ]);
                }
                
                return response()->json([
                    'success' => false,
                    'message' => 'Échec de la mise à jour de l\'échantillon',
                    'data' => $data
                ], 400);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Aucune donnée valide fournie pour la mise à jour',
                'received_data' => $data
            ], 400);
            
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la mise à jour de l\'échantillon ' . $id . ': ' . $e->getMessage() . '\n' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de l\'échantillon: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified echantillon from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $echantillon = EchantillonAnalyse::findOrFail($id);
            $echantillon->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Échantillon supprimé avec succès',
                'id' => $id
            ]);
            
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de l\'échantillon ' . $id . ': ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'échantillon: ' . $e->getMessage()
            ], 500);
        }
    }
}
