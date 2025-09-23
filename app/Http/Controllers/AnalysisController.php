<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $analyses = Analysis::latest()->paginate(10);
        return Inertia::render('Analyses/Index', [
            'analyses' => $analyses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Analyses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_rapport' => 'required|string|max:255',
            'lieu_prelevement' => 'required|string|max:255',
            'date_heure_prelevement' => 'required|date',
            'date_heure_reception_laboratoire' => 'required|date',
            'temperature_reception' => 'required|numeric',
            'conditions_conservation' => 'nullable|string',
            'date_heure_analyse' => 'required|date',
            'fournisseur_fabricant' => 'required|string|max:255',
            'conditionnement' => 'required|string|max:255',
            'agrement' => 'required|string|max:255',
            'lot' => 'required|string|max:255',
            'type_peche' => 'required|string|max:255',
            'nom_produit' => 'required|string|max:255',
            'espece' => 'required|string|max:255',
            'origine' => 'required|string|max:255',
            'date_emballage' => 'required|date',
            'date_consommation' => 'required|date',
            'imp' => 'required|numeric',
            'hx' => 'required|numeric',
            'note_nucleotide' => 'nullable|string',
            'cotation_fraicheur' => 'required|string|max:255',
            'observations' => 'nullable|string',
            'ref_rapport' => 'required|string|max:255',
        ]);

        Analysis::create($validated);

        return redirect()->route('analyses.index')
            ->with('success', 'Analyse créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Analysis $analysis)
    {
        return Inertia::render('Analyses/Show', [
            'analysis' => $analysis
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Analysis $analysis)
    {
        return Inertia::render('Analyses/Edit', [
            'analysis' => $analysis
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Analysis $analysis)
    {
        $validated = $request->validate([
            'numero_rapport' => 'required|string|max:255',
            // Add all other fields with their validation rules
        ]);

        $analysis->update($validated);

        return redirect()->route('analyses.index')
            ->with('success', 'Analyse mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Analysis $analysis)
    {
        $analysis->delete();

        return redirect()->route('analyses.index')
            ->with('success', 'Analyse supprimée avec succès.');
    }
}
