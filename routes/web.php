<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinancialYearController;

Route::get('/', function () {
    return view('financial-year');
});
Route::post('/financial-year', [FinancialYearController::class, 'getFinancialYear'])->name('financial-year');