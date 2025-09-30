<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Muestra una lista paginada de usuarios.
     */
    public function index()
    {
        $usuarios = User::orderBy('name')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $usuario->assignRole($request->role);

        return redirect()->route('usuarios.index')->with('exito', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra los detalles de un usuario específico.
     */
    public function show(User $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $usuario)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('usuarios.edit', compact('usuario', 'roles', 'permissions'));
    }

    /**
     * Actualiza un usuario en la base de datos.
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'string',
            'new_permission' => 'nullable|string|max:255',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->password) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        // 1. Sincronizar el rol
        $usuario->syncRoles($request->role);

        // 2. Manejar los permisos
        $permissionsToSync = $request->input('permissions', []);

        // 3. Crear el nuevo permiso si se proporcionó
        if ($request->filled('new_permission')) {
            $newPermissionName = $request->input('new_permission');
            $newPermission = Permission::firstOrCreate(['name' => $newPermissionName]);
            $permissionsToSync[] = $newPermission->name;
        }

        // 4. Sincronizar los permisos del usuario
        $usuario->syncPermissions($permissionsToSync);

        return redirect()->route('usuarios.index')->with('exito', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(User $usuario)
    {
        // No permitir que un usuario se elimine a sí mismo
        if (auth()->user()->id === $usuario->id) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')->with('exito', 'Usuario eliminado exitosamente.');
    }
}