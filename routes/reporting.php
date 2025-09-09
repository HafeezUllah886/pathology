<?php


use App\Http\Controllers\ReportingController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

   Route::get('reporting', [ReportingController::class, 'index'])->name('reporting.index');
   Route::get('reporting/tests/{id}', [ReportingController::class, 'tests'])->name('reporting.tests.index');
   Route::get('reporting/tests/{id}/parameters', [ReportingController::class, 'parameters'])->name('reporting.tests.parameters');
   Route::post('reporting/store', [ReportingController::class, 'store'])->name('reporting.store');
});
