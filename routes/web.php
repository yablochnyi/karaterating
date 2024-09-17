<?php

use App\Http\Controllers\GeneratePDFReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/panel');
});

Route::get('/panel/tournament-student-list-pdf/{id}', [GeneratePDFReportController::class, 'generatePDFReport'])
    ->middleware(['auth'])->name('generatePDFReport');
