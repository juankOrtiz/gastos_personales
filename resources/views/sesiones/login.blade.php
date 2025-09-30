@extends('layouts.auth')

@section('contenido')
    <div class="flex min-h-screen bg-gray-100">

        <div class="hidden md:flex items-center justify-center flex-1 bg-blue-600 p-8">
            <div class="text-center text-white">
                <h1 class="text-4xl font-extrabold mb-4">Mis Gastos Personales &copy;</h1>
                <p class="text-lg">Accede a tu panel de control de gastos personales.</p>
            </div>
        </div>

        <div class="flex items-center justify-center flex-1 p-4 sm:p-8">
            <div class="w-full max-w-sm bg-white rounded-lg shadow-lg p-6 sm:p-8">
                <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Iniciar sesión</h1>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('login.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                            placeholder="ejemplo@correo.com" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Contraseña</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                            placeholder="********" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Recuérdame
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                            Iniciar sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection