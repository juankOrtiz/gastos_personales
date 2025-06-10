@extends('layouts.app')

@section('titulo', 'Lista de transacciones')

@section('contenido')

    <div class="container mx-auto px-4 py-8">
        {{-- Título y botón alineados --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Listado de transacciones</h1>
            <a href="{{ route('transacciones.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                Crear transacción
            </a>
        </div>

        {{-- Notificación de éxito --}}
        @if(session('exito'))
            <div class="relative bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex justify-between items-center" role="alert">
                <span class="block sm:inline">{{ session('exito') }}</span>
                <button type="button" class="text-green-700 hover:text-green-900 font-bold text-xl leading-none" onclick="this.parentElement.style.display='none';">
                    &times; {{-- Esto es un carácter 'X' estilizado --}}
                </button>
            </div>
        @endif

        {{-- Notificación de error --}}
        @if(session('error'))
            <div class="relative bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex justify-between items-center" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button type="button" class="text-red-700 hover:text-red-900 font-bold text-xl leading-none" onclick="this.parentElement.style.display='none';">
                    &times; {{-- Esto es un carácter 'X' estilizado --}}
                </button>
            </div>
        @endif

        @empty($datos)
            <p class="text-center text-gray-600 text-lg py-10">No existen transacciones actualmente</p>
        @else
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ID de usuario
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Descripción
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Monto
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Fecha de transacción
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Creado en
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actualizado en
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $dato)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $dato['user_id'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $dato['description'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $dato['amount'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $dato['transaction_date'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $dato['created_at'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $dato['updated_at'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="{{ route('transacciones.show', $dato['id']) }}">Ver</a>
                                    <a href="{{ route('transacciones.edit', $dato['id']) }}">Editar</a>
                                    <form action="{{ route('transacciones.destroy', $dato['id']) }}" method="POST" onsubmit="return confirm('Estas seguro que deseas eliminar la transaccion?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endempty
    </div>
    <script>
        // Se ejecuta el codigo JS solamente cuando haya cargado la pagina y todos los elementos del DOM
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Cargo la pagina");
        });
    </script>
@endsection