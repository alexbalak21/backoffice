<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\CompanyController;

Route::resource('companies', CompanyController::class);

