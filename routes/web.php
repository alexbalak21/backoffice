<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SampleAnalysisController;

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


//analysis-table
Route::get('analysis-table', [SampleAnalysisController::class, 'analysisTable'])->name('analysis-table');

