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
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Zona publica de la aplicacion
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('inicio');

Route::middleware(['guest'])->group(function() {
    // Ruta que muestre la pagina de login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login')
        ->middleware(['guest']);

    // Ruta que procese los datos del login
    Route::post('/login', [AuthController::class, 'storeLogin'])
        ->name('login.store');

    Route::get('/forgot-password', function () {
        return view('sesiones.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('sesiones.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');
});

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

    Route::resource('usuarios', UserController::class)
        ->middleware(['can:ver-listado-usuarios']);

    Route::post('/notifications/{notification}/read', NotificationController::class)
        ->name('notifications.read');
});

// Rutas de reseteo de contrasenia
// 1 ruta para mostrar el formulario de envio de reseteo
// 1 ruta para mostrar el formulario de reseteo de contrasenia
// 1 ruta para confirmar la nueva contrasenia