@extends('layouts.app')

@section('titulo', 'Editar Usuario')

@section('contenido')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Editar Usuario: {{ $usuario->name }}</h1>

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Datos del usuario</h2>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-semibold mb-2">Nueva Contraseña
                            (opcional)</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar Nueva
                            Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-4">Roles y Permisos</h2>
                    <div class="mb-6">
                        <label for="role" class="block text-gray-700 font-semibold mb-2">Rol</label>
                        <select name="role" id="role"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                            required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @if ($usuario->hasRole($role->name)) selected @endif>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Permisos</label>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                            @foreach ($permissions as $permission)
                                <div class="flex items-center">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        id="permission-{{ $permission->id }}" @if ($usuario->hasPermissionTo($permission->name))
                                        checked @endif
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="permission-{{ $permission->id }}"
                                        class="ml-2 text-sm text-gray-700">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="new_permission" class="block text-gray-700 font-semibold mb-2">Crear nuevo
                            permiso</label>
                        <input type="text" name="new_permission" id="new_permission"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('new_permission') border-red-500 @enderror"
                            placeholder="Ej: editar-perfil">
                        @error('new_permission')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700 transition-colors duration-200">
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
@endsection