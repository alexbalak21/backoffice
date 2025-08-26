<?php

namespace App\Http\Controllers;

use App\Models\SampleAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'sampling_date' => 'required|date',
            'sampling_location' => 'required|string|max:255',
            'lab_receipt_datetime' => 'required|date',
            'receipt_temperature' => 'required|numeric',
            'storage_conditions' => 'required|string',
            'analysis_date' => 'required|date',
            'supplier_manufacturer' => 'required|string|max:255',
            'packaging' => 'required|string|max:255',
            'approval_number' => 'required|string|max:255',
            'batch_number' => 'required|string|max:255',
            'fishing_type' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'packaging_date' => 'required|date',
            'best_before_date' => 'required|date',
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
            'sampling_date' => 'required|date',
            'sampling_location' => 'required|string|max:255',
            'lab_receipt_datetime' => 'required|date',
            'receipt_temperature' => 'required|numeric',
            'storage_conditions' => 'required|string',
            'analysis_date' => 'required|date',
            'supplier_manufacturer' => 'required|string|max:255',
            'packaging' => 'required|string|max:255',
            'approval_number' => 'required|string|max:255',
            'batch_number' => 'required|string|max:255',
            'fishing_type' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'packaging_date' => 'required|date',
            'best_before_date' => 'required|date',
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
}
