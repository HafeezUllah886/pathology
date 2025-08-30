<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\confirmPasswordController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\TestGroupsController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\TestValuesController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

   Route::resource('tests', TestsController::class);
   Route::resource('test_groups', TestGroupsController::class);
   Route::resource('test_values', TestValuesController::class);

});
