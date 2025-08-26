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
