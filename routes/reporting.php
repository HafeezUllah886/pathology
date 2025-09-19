<?php


use App\Http\Controllers\ReportingController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

   Route::get('reporting', [ReportingController::class, 'index'])->name('reporting.index');
   Route::get('reporting/tests/{id}', [ReportingController::class, 'tests'])->name('reporting.tests.index');
   Route::get('reporting/tests/{id}/parameters', [ReportingController::class, 'parameters'])->name('reporting.tests.parameters');
   Route::post('reporting/store', [ReportingController::class, 'store'])->name('reporting.store');
   Route::get('reporting/edit/{id}', [ReportingController::class, 'edit'])->name('reporting.edit');
   Route::post('reporting/update/{id}', [ReportingController::class, 'update'])->name('reporting.update');

   Route::get('reporting/print_index/{id}', [ReportingController::class, 'print_filter'])->name('reporting.print.filter');
   Route::get('reporting/print', [ReportingController::class, 'print'])->name('reporting.print');
});
