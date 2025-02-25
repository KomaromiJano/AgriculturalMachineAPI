<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AgriculturalMachineController;
use App\Http\Controllers\API\RentalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('machines', AgriculturalMachineController::class);
Route::apiResource('rentals', RentalController::class)->except(['update']);