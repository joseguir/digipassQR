@extends('adminlte::page')

@section('title', 'Validar QR')

@section('content_header')
    <h1>Validar Entrada por QR</h1>
@stop

@section('content')
    <div class="row">
        @foreach($eventos as $evento)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">{{ $evento->titulo }}</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Fecha:</strong> {{ $evento->fecha ?? 'Sin fecha' }}</p>
                        <p><strong>Dirección:</strong> {{ $evento->direccion ?? 'Sin ubicación' }}</p>
                        <a href="{{ route('validation.show', $evento) }}" class="btn btn-success">
                            Seleccionar
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
