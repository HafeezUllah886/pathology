<?php


use App\Http\Controllers\ReportingController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

   Route::get('reporting', [ReportingController::class, 'index'])->name('reporting.index');
   Route::get('reporting/tests/{id}', [ReportingController::class, 'tests'])->name('reporting.tests.index');
});
