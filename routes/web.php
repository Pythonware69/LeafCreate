<?php

use App\Http\Controllers\pointsController;
use App\Http\Controllers\polygonsController;
use App\Http\Controllers\polylinesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/peta', function () {
    return view('map');
})->name('peta');

Route::get('/tabel', function () {
    return view('table');
})->name('tabel');

//points
Route::post('/store-points', [pointsController::class, 'store'])
->name('points.store');
Route::delete('/destroy-points/{id}', [pointsController::class, 'destroy'])
->name('points.delete');

//polylines
Route::post('/store-polylines', [polylinesController::class, 'store'])
->name('polylines.store');
Route::delete('/destroy-polylines/{id}', [polylinesController::class, 'destroy'])
->name('polylines.delete');

//polygons
Route::post('/store-polygons', [polygonsController::class, 'store'])
->name('polygons.store');
Route::delete('/destroy-polygons/{id}', [polygonsController::class, 'destroy'])
->name('polygons.delete');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
