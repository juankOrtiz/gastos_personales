@extends('layouts.app')

@section('titulo', 'Detalle de transaccion')

@section('contenido')
    <div>
        <div>
            <h1>Detalle de transaccion</h1>
            <div>
                <p><strong>ID:</strong> {{ $transaccion['id'] }}</p>
                <p><strong>ID de usuario:</strong> {{ $transaccion['user_id'] }}</p>
                <p><strong>Descripcion:</strong> {{ $transaccion['description'] }}</p>
                <p><strong>Monto:</strong> {{ $transaccion['amount'] }}</p>
                <p><strong>Fecha de transaccion:</strong> {{ $transaccion['transaction_date'] }}</p>
                <p><strong>Fecha de creacion:</strong> {{ $transaccion['created_at'] }}</p>
                <p><strong>Fecha de actualizacion:</strong> {{ $transaccion['updated_at'] }}</p>
            </div>
            <a href="{{ route('transacciones.index') }}">Volver al listado</a>
            <a href="{{ route('transacciones.edit', $transaccion['id']) }}">Editar</a>
        </div>
    </div>
@endsection