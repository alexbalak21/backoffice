<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SampleAnalysisController;
use App\Http\Controllers\EchantillonAnalyseController;

// Home route
Route::get('/', function () {
    return view('home');
});

// Company routes
Route::resource('companies', CompanyController::class);

// Sample Analysis routes
Route::resource('sample-analyses', SampleAnalysisController::class);
Route::post('sample-analyses/{sampleAnalysis}/clone', [SampleAnalysisController::class, 'clone'])
    ->name('sample-analyses.clone');

// PDF Export
Route::get('sample-analyses/{sampleAnalysis}/export-pdf', [SampleAnalysisController::class, 'exportPdf'])
    ->name('sample-analyses.export-pdf');

// JSON Import
Route::get('/import-json', [SampleAnalysisController::class, 'showImportForm'])->name('sample-analyses.import-json');
Route::post('/import-json', [SampleAnalysisController::class, 'importJson'])->name('sample-analyses.import-json.submit');

// PDF Management
Route::resource('pdfs', \App\Http\Controllers\PdfController::class);
Route::get('pdfs/{pdf}/download', [\App\Http\Controllers\PdfController::class, 'download'])->name('pdfs.download');


// Echantillon Analyse routes
Route::resource('echantillon-analyses', EchantillonAnalyseController::class)->only([
    'store', 'destroy'
]);

// Custom route for analysis table
Route::get('echantillon-analyses/analysis-table', [EchantillonAnalyseController::class, 'analysisTable'])->name('echantillon-analyses.analysis-table');

