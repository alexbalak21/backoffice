<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleAnalysisController;

Route::get('/import-json', [SampleAnalysisController::class, 'showImportForm'])->name('imports.json.form');
Route::post('/import-json', [SampleAnalysisController::class, 'importJson'])->name('imports.json.submit');
