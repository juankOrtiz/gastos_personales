@extends('layouts.auth')

@section('contenido')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4 sm:p-6">
        <div class="w-full max-w-sm bg-white rounded-lg shadow-lg p-6 sm:p-8">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Recuperar Contraseña</h1>
            <p class="text-center text-gray-600 mb-6 text-sm">Ingresa tu correo electrónico para recibir un enlace de
                recuperación.</p>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                        required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        Enviar Enlace de Recuperación
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection