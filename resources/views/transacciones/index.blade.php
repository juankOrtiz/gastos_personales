@extends('layouts.app')

@section('titulo', 'Lista de transacciones')

@section('contenido')

    <div class="container mx-auto px-4 py-8">
        {{-- Título y botón alineados --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Listado de transacciones</h1>
            <a href="{{ route('transacciones.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                Crear transacción
            </a>
        </div>

        {{-- Notificación de éxito --}}
        @if(session('exito'))
            <div class="relative bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex justify-between items-center"
                role="alert">
                <span class="block sm:inline">{{ session('exito') }}</span>
                <button type="button" class="text-green-700 hover:text-green-900 font-bold text-xl leading-none"
                    onclick="this.parentElement.style.display='none';">
                    &times; {{-- Esto es un carácter 'X' estilizado --}}
                </button>
            </div>
        @endif

        {{-- Notificación de error --}}
        @if(session('error'))
            <div class="relative bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex justify-between items-center"
                role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button type="button" class="text-red-700 hover:text-red-900 font-bold text-xl leading-none"
                    onclick="this.parentElement.style.display='none';">
                    &times; {{-- Esto es un carácter 'X' estilizado --}}
                </button>
            </div>
        @endif

        @empty($transacciones)
            <p class="text-center text-gray-600 text-lg py-10">No existen transacciones actualmente</p>
        @else
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ID de transaccion
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Descripción
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Monto
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Fecha de transacción
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Creado en
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actualizado en
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transacciones as $transaccion)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{-- Enlace de "Ver" --}}
                                    <div class="flex items-center">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $transaccion['id'] }}</p>
                                        <a href="{{ route('transacciones.show', $transaccion->id) }}"
                                            class="ml-2 text-blue-500 hover:text-blue-700" title="Ver detalle">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0l-6.75 6.75M21 3v6.75" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $transaccion['descripcion'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $transaccion['monto'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $transaccion['fecha_transaccion'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $transaccion['created_at'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $transaccion['updated_at'] }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex gap-2 items-center">
                                    {{-- Enlace de "Editar" --}}
                                    <a href="{{ route('transacciones.edit', $transaccion->id) }}"
                                        class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 hover:bg-green-200 transition-colors duration-200">
                                        Editar
                                    </a>
                                    {{-- Botón de "Eliminar" --}}
                                    <form action="{{ route('transacciones.destroy', $transaccion->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro que deseas eliminar la transacción?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800 hover:bg-red-200 transition-colors duration-200 cursor-pointer">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $transacciones->links() }}
            </div>
        @endempty
    </div>
    <script>
        // Se ejecuta el codigo JS solamente cuando haya cargado la pagina y todos los elementos del DOM
        document.addEventListener('DOMContentLoaded', function () {
            console.log("Cargo la pagina");
        });
    </script>
@endsection
