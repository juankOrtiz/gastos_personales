@extends('layouts.app')

@section('titulo', 'Nuevo comprobante')

@section('contenido')
    <h1>Nuevo comprobante</h1>

    <form action="{{ route('comprobantes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="comprobante">Comprobante:</label>
            <input type="file" name="comprobante" id="comprobante" required>
            @error('comprobante')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <a href="{{ route('comprobantes.index') }}">Volver</a>
            <button type="submit">Guardar comprobante</button>
        </div>
    </form>
@endsection