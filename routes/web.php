<?php

use App\Http\Controllers\PruebaController;
use App\Http\Controllers\TransaccionesController;
use App\Http\Controllers\ComprobantesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// Zona publica de la aplicacion
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
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
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

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

    Route::post('/notifications/{notification}/read', NotificationController::class)
        ->name('notifications.read');
});

// Rutas de reseteo de contrasenia
// 1 ruta para mostrar el formulario de envio de reseteo
// 1 ruta para mostrar el formulario de reseteo de contrasenia
// 1 ruta para confirmar la nueva contrasenia