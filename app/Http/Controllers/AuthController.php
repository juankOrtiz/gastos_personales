<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('sesiones.login');
    }

    public function storeLogin(Request $request) {
        // 1) Validar restricciones de los campos
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2) Preguntar si la combinacion de usuario y contrasenia es valida
        if(Auth::attempt($credenciales)) {
            // Regenerar la sesion (esto crea la cookie en el navegador y la sesion en el servidor)
            $request->session()->regenerate();
            // Redirigir al usuario al dashboard
            return redirect()->intended('/dashboard');
        } else {
            return back()->withErrors([
                'email' => 'Las credenciales no son correctas.'
            ])->onlyInput('email');
        }
    }
}
