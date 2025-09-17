@extends('adminlte::page')

@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp


@section('title', 'Detalle de Entrada')

@section('content_header')
    <h1>Detalle de Entrada</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Evento:</strong> {{ $entrada->lote->evento->titulo }}</p>
            <p><strong>Lote:</strong> {{ $entrada->lote->nombre }}</p>
            <p><strong>Precio:</strong> ${{ $entrada->lote->precio }}</p>
            <p><strong>Usuario:</strong> {{ $entrada->usuario->name }} ({{ $entrada->usuario->email }})</p>
            <p><strong>Estado:</strong> {{ ucfirst($entrada->estado->nombre) }}</p>
            <p><strong>Fecha de Compra:</strong> {{ $entrada->fecha_compra }}</p>
            <p><strong>Código QR:</strong></p>
            <div>
                {!! QrCode::size(200)->generate($entrada->codigo_qr) !!}
            </div>
            <a href="{{ route('entradas.qr.download', $entrada) }}" class="btn btn-success mt-2">
                Descargar QR
            </a>

        </div>
    </div>

    <a href="{{ route('entradas.index') }}" class="btn btn-secondary mt-2">Volver al listado</a>
@stop