<?php

use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/settings.php';
require __DIR__ . '/receipts.php';
require __DIR__ . '/finance.php';

Route::middleware('auth')->group(function () {
    
Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

});




