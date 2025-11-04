@extends('adminlte::page')

@section('title', 'Detalle Evento')

@section('content_header')
    <h1>Detalle del Evento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>{{ $evento->titulo }}</h3>

            @if($evento->img && file_exists(public_path($evento->img)))
                <div class="mb-3">
                    <img src="{{ asset($evento->img) }}" alt="Imagen del evento" class="img-fluid rounded" style="max-width: 400px;">
                </div>
            @endif

            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y H:i') }}</p>
            <p><strong>Lugar:</strong> {{ $evento->direccion }}</p>
        </div>
    </div>

    <a href="{{ route('eventos.index') }}" class="btn btn-secondary mt-3">Volver</a>
@stop
