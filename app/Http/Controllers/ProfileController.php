<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Muestra la página de perfil del usuario.
     */
    public function index()
    {
        $user = auth()->user();
        $transaccionCount = $user->transacciones()->count();

        return view('profile', compact('user', 'transaccionCount'));
    }

    /**
     * Procesa la solicitud para actualizar el perfil del usuario.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ];

        // Validaciones condicionales para la contraseña
        if ($request->has('password_edit')) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $validatedData = $request->validate($rules);

        // Actualiza los datos del usuario
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Si se envió una nueva contraseña, la actualiza
        if ($request->has('password_edit')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return Redirect::route('profile.index')->with('success', 'Perfil actualizado exitosamente.');
    }
}