<?php

use App\Http\Controllers\PruebaController;
use App\Http\Controllers\TransaccionesController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/prueba', [PruebaController::class, 'index'])
    ->name('prueba.index');

Route::get('/prueba2', [PruebaController::class, 'crear'])
    ->name('prueba.crear');

Route::get('/transacciones', [TransaccionesController::class, 'index'])
    ->name('transacciones.index');
