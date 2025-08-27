@extends('layouts.app')

@section('titulo', 'Nueva transaccion')

@section('contenido')
    <div class="container mx-auto px-4 py-8 max-w-lg"> {{-- Contenedor principal centrado y con ancho máximo --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Crear nueva transacción</h1>

        {{-- Mensaje general de error si hay algún problema con el formulario --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline">Corrija los errores del formulario.</span>
                {{-- Puedes descomentar esto si quieres mostrar una lista de todos los errores --}}
                {{--
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                --}}
            </div>
        @endif

        <form action="{{ route('transacciones.update', $transaccion->id) }}" method="POST"
            class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            {{-- Campo Descripción --}}
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion"
                    value="{{ old('descripcion', $transaccion->descripcion) }}" required class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                  @error('descripcion') border-red-500 @enderror">
                @error('descripcion')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Monto --}}
            <div class="mb-4">
                <label for="monto" class="block text-gray-700 text-sm font-bold mb-2">Monto:</label>
                <input type="number" name="monto" id="monto" value="{{ old('monto', $transaccion->monto) }}" required step="
                        0.01" {{-- Agregado step para decimales --}} class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                  @error('monto') border-red-500 @enderror">
                @error('monto')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Fecha de transacción --}}
            <div class="mb-6">
                <label for="fecha_transaccion" class="block text-gray-700 text-sm font-bold mb-2">Fecha transacción:</label>
                <input type="date" name="fecha_transaccion" id="fecha_transaccion"
                    value="{{ old('fecha_transaccion', $transaccion->fecha_transaccion) }}" required class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                  @error('fecha_transaccion') border-red-500 @enderror">
                @error('fecha_transaccion')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones de acción --}}
            <div class="flex items-center justify-between">
                <a href="{{ route('transacciones.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
                    Actualizar transacción
                </button>
            </div>
        </form>
    </div>
@endsection
