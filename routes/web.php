<?php

use App\Http\Controllers\PruebaController;
use App\Http\Controllers\TransaccionesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/pagina-prueba', [PruebaController::class, 'index'])
    ->name('prueba.index');

Route::get('/prueba2', [PruebaController::class, 'crear'])
    ->name('prueba.crear');

// Muestra la pagina con el listado de transacciones
Route::get('/transacciones', [TransaccionesController::class, 'index'])
    ->name('transacciones.index');

// Muestra la pagina con el formulario para crear una transaccion
Route::get('/transacciones/create', [TransaccionesController::class, 'create'])
    ->name('transacciones.create');

// Recibe los datos del formulario de creacion de una transaccion
Route::post('/transacciones', [TransaccionesController::class, 'store'])
    ->name('transacciones.store');
