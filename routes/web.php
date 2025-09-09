<?php

use App\Http\Controllers\PruebaController;
use App\Http\Controllers\TransaccionesController;
use App\Http\Controllers\ComprobantesController;
use App\Http\Controllers\AuthController;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Route;

// Zona publica de la aplicacion
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

// Ruta que muestre la pagina de login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware(['guest']);

// Ruta que procese los datos del login
Route::post('/login', [AuthController::class, 'storeLogin'])
    ->name('login.store');

// Zona privada de la aplicacion
Route::middleware(['auth'])->group(function() {
    // Ruta que muestre el "panel de control" de la aplicacion
    Route::get('/dashboard', function() {
        echo "Bienvenido al dashboard (esta zona es privada)";
    })->name('dashboard');

    // Ruta para cerrar sesion
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::controller(TransaccionesController::class)->group(function() {
        // Muestra la pagina con el listado de transacciones
        Route::get('/transacciones', 'index')
            ->name('transacciones.index');

        // Muestra la pagina con el formulario para crear una transaccion
        Route::get('/transacciones/create', 'create')
            ->name('transacciones.create');

        // Recibe los datos del formulario de creacion de una transaccion
        Route::post('/transacciones', 'store')
            ->name('transacciones.store');

        // Muestra una transaccion especifica
        Route::get('/transacciones/{transaccion}', 'show')
            ->name('transacciones.show');

        // Muestra el formulario para editar una transaccion especifica
        Route::get('/transacciones/{transaccion}/edit', 'edit')
            ->name('transacciones.edit');

        // Actualiza una transaccion especifica
        Route::put('/transacciones/{transaccion}', 'update')
            ->name('transacciones.update');

        // Elimina una transaccion especifica
        Route::delete('/transacciones/{transaccion}', 'destroy')
            ->name('transacciones.destroy');
    });

    Route::resource('comprobantes', ComprobantesController::class)
        ->except(['show', 'edit', 'update', 'destroy']);

    Route::get('/usuarios', function() {
        echo "Listado de usuarios";
    })->name('usuarios.index')->middleware(['can:ver-listado-usuarios']);
});
