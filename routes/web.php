<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landingpage'])->name('home');

Route::get('/peta', [PageController::class, 'peta'])->name('peta');

Route::get('/mapedit', [PageController::class, 'mapedit'])->name('mapedit');

Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');

//points
Route::post('/store-points', [\App\Http\Controllers\pointsController::class, 'store'])
->name('points.store');
Route::put('/update-points/{id}', [\App\Http\Controllers\pointsController::class, 'update'])
->name('points.update');
Route::delete('/destroy-points/{id}', [\App\Http\Controllers\pointsController::class, 'destroy'])
->name('points.delete');
Route::patch('/update-points/{id}', [\App\Http\Controllers\pointsController::class, 'update'])
->name('points.update');

//polylines
Route::post('/store-polylines', [\App\Http\Controllers\polylinesController::class, 'store'])
->name('polylines.store');
Route::put('/update-polylines/{id}', [\App\Http\Controllers\polylinesController::class, 'update'])
->name('polylines.update');
Route::patch('/update-polylines/{id}', [\App\Http\Controllers\polylinesController::class, 'update'])
->name('polylines.update');
Route::delete('/destroy-polylines/{id}', [\App\Http\Controllers\polylinesController::class, 'destroy'])
->name('polylines.delete');

//polygons
Route::post('/store-polygons', [\App\Http\Controllers\polygonsController::class, 'store'])
->name('polygons.store');
Route::put('/update-polygons/{id}', [\App\Http\Controllers\polygonsController::class, 'update'])
->name('polygons.update');
Route::patch('/update-polygons/{id}', [\App\Http\Controllers\polygonsController::class, 'update'])
->name('polygons.update');
Route::delete('/destroy-polygons/{id}', [\App\Http\Controllers\polygonsController::class, 'destroy'])
->name('polygons.delete');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
