@extends('adminlte::page')

@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

@section('title', 'Detalle de Entrada')

@section('content_header')
    <h1>Detalle de Entrada</h1>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ $entrada->lote->evento->titulo }} - {{ $entrada->lote->nombre }}</h4>
            </div>
            <div class="card-body">


                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Precio:</strong> ${{ $entrada->lote->precio }}</p>
                        <p><strong>Usuario:</strong> {{ $entrada->usuario->name }} <br> <small>{{ $entrada->usuario->email }}</small></p>
                        <p><strong>Estado:</strong> <span class="badge bg-info">{{ $entrada->is_used ? 'Usada' : 'No usada' }}</span></p>
                         <p>
                            <strong>Fecha de Compra:</strong>
                            {{ \Carbon\Carbon::parse($entrada->fecha_compra)->locale('es')->isoFormat('D [de] MMMM') }}
                           
                        </p>
                        <p>
                            <strong>Fecha de Evento:</strong>
                            {{ \Carbon\Carbon::parse($entrada->lote->evento->fecha)->locale('es')->isoFormat('D [de] MMMM [de] YYYY [a las] HH:mm') }}


                           
                        </p>
                    </div>
                    <div class="col-md-6 text-center">
                        <p><strong>Código QR:</strong></p>
                        <div class="mb-2">
                            {!! QrCode::size(200)->generate($entrada->codigo_qr) !!}
                        </div>
                        <a href="{{ route('entradas.qr.download', $entrada) }}" class="btn btn-success">
                            Descargar QR
                        </a>
                    </div>
                </div>

               
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('entradas.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
@stop