<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



use App\Http\Controllers\MpesaController;

Route::post('/mpesa/validation', [MpesaController::class, 'validation']);
Route::post('/mpesa/confirmation', [MpesaController::class, 'confirmation']);

