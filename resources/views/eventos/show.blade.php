@extends('adminlte::page')

@section('title', 'Detalle Evento')

@section('content_header')
    <h1>Detalle del Evento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>{{ $evento->titulo }}</h3>
            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
            <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
            <p><strong>Lugar:</strong> {{ $evento->lugar }}</p>
        </div>
    </div>

     <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Volver</a>
@stop