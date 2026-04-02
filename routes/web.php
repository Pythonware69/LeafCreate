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
Route::post('/points', [pointsController::class, 'store'])
->name('points.store');

//polylines
Route::post('/polylines', [polylinesController::class, 'store'])
->name('polylines.store');

//polygons
Route::post('/polygons', [polygonsController::class, 'store'])
->name('polygons.store');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
