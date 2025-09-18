<?php

use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReceiptTestsController;
use App\Http\Controllers\ReceiptTestsParametersController;
use App\Models\Tests;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

   Route::resource('receipts', ReceiptController::class);
   Route::resource('receipt_tests', ReceiptTestsController::class);
   Route::resource('receipt_tests_parameters', ReceiptTestsParametersController::class);
   Route::post('receipts/cancel', [ReceiptController::class, 'cancel'])->name('receipts.cancel');

   Route::get('receipt/getsingletest/{id}', function($id){

      $test = Tests::find($id);
      $parameters = $test->parameters()->where('type','!=', 'Heading')->get('title');

      $test->parameters = $parameters->pluck('title')->implode(', ');
     
      return response()->json($test);
   
   })->name('receipt.getsingletest');

});
