<?php

use App\Http\Controllers\PruebaController;
use App\Http\Controllers\TransaccionesController;
use App\Http\Controllers\ComprobantesController;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Route;
use Psy\Readline\Transient;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/pagina-prueba', [PruebaController::class, 'index'])
    ->name('prueba.index');

Route::get('/prueba2', [PruebaController::class, 'crear'])
    ->name('prueba.crear');

// Muestra la pagina con el listado de transacciones
/*Route::get('/transacciones', [TransaccionesController::class, 'index'])
    ->name('transacciones.index');

// Muestra la pagina con el formulario para crear una transaccion
Route::get('/transacciones/create', [TransaccionesController::class, 'create'])
    ->name('transacciones.create');

// Recibe los datos del formulario de creacion de una transaccion
Route::post('/transacciones', [TransaccionesController::class, 'store'])
    ->name('transacciones.store');

// Muestra una transaccion especifica
Route::get('/transacciones/{transaccion}', [TransaccionesController::class, 'show'])
    ->name('transacciones.show');

// Muestra el formulario para editar una transaccion especifica
Route::get('/transacciones/{transaccion}/edit', [TransaccionesController::class, 'edit'])
    ->name('transacciones.edit');

// Actualiza una transaccion especifica
Route::put('/transacciones/{transaccion}', [TransaccionesController::class, 'update'])
    ->name('transacciones.update');

// Elimina una transaccion especifica
Route::delete('/transacciones/{transaccion}', [TransaccionesController::class, 'destroy'])
    ->name('transacciones.destroy');*/

// Definir las 7 rutas REST
Route::resource('transacciones', TransaccionesController::class);

// Definir las 7 rutas REST, excepto las 3 mencionadas
//Route::resource('transacciones', TransaccionesController::class)
//    ->except(['destroy', 'edit', 'update']);

Route::resource('comprobantes', ComprobantesController::class)
    ->except(['show', 'edit', 'update', 'destroy']);

Route::get('/test', function() {

    // SELECT * FROM transacciones;
    // $transacciones = Transaccion::all();

    // Obtener un registro de la tabla
    // $transaccion = Transaccion::find(2);

    // Where
    /*$transaccion = Transaccion::where('id', '>=', 1)
        ->select('descripcion')
        ->first();
    dd($transaccion);*/

    // INSERT: forma extensa
    /*$transaccion = new Transaccion();
    $transaccion->descripcion = 'Pague la luz';
    $transaccion->monto = 50000;
    $transaccion->fecha_transaccion = date('Y-m-d');
    $transaccion->save();*/

    // INSERT: forma corta
    /*Transaccion::create([
        'descripcion' => 'Pague el agua',
        'monto' => 15000,
        'fecha_transaccion' => date('Y-m-d'),
    ]);
    Transaccion::create([
        'descripcion' => 'Pague el agua',
        'monto' => 18000,
        'fecha_transaccion' => date('Y-m-d'),
    ]);
    Transaccion::create([
        'descripcion' => 'Pague el agua',
        'monto' => 20000,
        'fecha_transaccion' => date('Y-m-d'),
    ]);*/

    // UPDATE
    /*Transaccion::where('id', 3)
        ->update([
            'monto' => 15000
        ]);*/

    // DELETE
    Transaccion::destroy(3);
    // Transaccion::where('id', '<', 10)->delete();

    $transacciones = Transaccion::withTrashed()
        ->where('id', 3)
        ->forceDelete();
    dd($transacciones);
});