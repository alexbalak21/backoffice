<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SampleAnalysisController;

Route::get('/', function () {
    return view('home');
});

// Company routes
Route::resource('companies', CompanyController::class);

// Sample Analysis routes
Route::resource('sample-analyses', SampleAnalysisController::class);
Route::post('sample-analyses/{sampleAnalysis}/clone', [SampleAnalysisController::class, 'clone'])
    ->name('sample-analyses.clone');

// Sample Analysis PDF Export
Route::get('/sample-analyses/{sampleAnalysis}/export-pdf', [SampleAnalysisController::class, 'exportPdf'])
    ->name('sample-analyses.export-pdf');
