@extends('adminlte::page')

@section('title', 'Confirmación de Entrada')

@section('content_header')
    <h1>Entrada Confirmada</h1>
@stop

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Validación Exitosa</h3>
        </div>
        <div class="card-body">
            <p><strong>Nombre del Usuario:</strong> {{ $entrada->lote->evento->usuario->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $entrada->lote->evento->usuario->email ?? 'N/A' }}</p>
            <p><strong>Evento:</strong> {{ $entrada->lote->evento->titulo ?? 'N/A' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('validation.index') }}" class="btn btn-primary">
                Volver a Validación
            </a>
        </div>
    </div>
@endsection

