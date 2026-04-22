<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [apiController::class, 'points']);
Route::get('/polylines', [apiController::class, 'polylines']);
Route::get('/polygons', [apiController::class, 'polygons']);
