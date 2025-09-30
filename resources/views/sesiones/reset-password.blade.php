@extends('layouts.auth')

@section('contenido')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4 sm:p-6">
        <div class="w-full max-w-sm bg-white rounded-lg shadow-lg p-6 sm:p-8">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Restablecer Contraseña</h1>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Correo Electrónico</label>
                    <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required
                        autocomplete="email" autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Nueva Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password-confirm" class="block text-gray-700 text-sm font-semibold mb-2">Confirmar
                        Contraseña</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required
                        autocomplete="new-password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        Restablecer Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection