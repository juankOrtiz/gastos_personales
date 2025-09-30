@extends('layouts.app')

@section('titulo', 'Detalles de Usuario')

@section('contenido')
    <div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Detalles del Usuario: {{ $usuario->name }}</h1>

        <div class="space-y-4 text-gray-700">
            <div>
                <span class="font-semibold">ID:</span>
                <p class="mt-1 px-4 py-2 bg-gray-100 rounded-md">{{ $usuario->id }}</p>
            </div>
            <div>
                <span class="font-semibold">Nombre:</span>
                <p class="mt-1 px-4 py-2 bg-gray-100 rounded-md">{{ $usuario->name }}</p>
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                <p class="mt-1 px-4 py-2 bg-gray-100 rounded-md">{{ $usuario->email }}</p>
            </div>
            <div>
                <span class="font-semibold">Rol:</span>
                <p class="mt-1 px-4 py-2 bg-gray-100 rounded-md">{{ $usuario->roles->first()->name ?? 'Sin Rol' }}</p>
            </div>
            <div>
                <span class="font-semibold">Fecha de Creación:</span>
                <p class="mt-1 px-4 py-2 bg-gray-100 rounded-md">{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <span class="font-semibold">Última Actualización:</span>
                <p class="mt-1 px-4 py-2 bg-gray-100 rounded-md">{{ $usuario->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('usuarios.index') }}"
                class="inline-block px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                Volver al listado
            </a>
        </div>
    </div>
@endsection