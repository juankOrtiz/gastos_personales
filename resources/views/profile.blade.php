@extends('layouts.app')

@section('titulo', 'Perfil de Usuario')

@section('contenido')
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Mi Perfil</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center justify-center text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $user->name }}</h2>
                <div class="space-y-2 text-gray-600">
                    <p>
                        <span class="font-semibold">Miembro desde:</span>
                        {{ $user->created_at->format('d/m/Y') }}
                    </p>
                    <p>
                        <span class="font-semibold">Última actualización:</span>
                        {{ $user->updated_at->format('d/m/Y') }}
                    </p>
                    <p>
                        <span class="font-semibold">Transacciones realizadas:</span>
                        {{ $transaccionCount }}
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-center">Actualizar Datos</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center mb-6">
                        <input type="checkbox" name="password_edit" id="password_edit"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="password_edit" class="ml-2 block text-gray-700">Deseo cambiar mi contraseña</label>
                    </div>

                    <div id="password-fields" class="hidden">
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-semibold mb-2">Nueva Contraseña</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar
                                Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-200">
                            Actualizar Perfil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordEditCheckbox = document.getElementById('password_edit');
            const passwordFields = document.getElementById('password-fields');

            passwordEditCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    passwordFields.classList.remove('hidden');
                    passwordFields.querySelectorAll('input').forEach(input => input.setAttribute('required', 'required'));
                } else {
                    passwordFields.classList.add('hidden');
                    passwordFields.querySelectorAll('input').forEach(input => input.removeAttribute('required'));
                }
            });
        });
    </script>
@endpush