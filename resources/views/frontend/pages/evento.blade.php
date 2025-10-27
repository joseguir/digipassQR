@extends('frontend.layouts.master')

@section('title', 'Detalle de Evento')

@section('content')

<div class="container">

    <!-- Botón volver -->
    <div class="mb-4">
        <a href="/" class="btn btn-back">
            ← Volver al inicio
        </a>
    </div>

    <!-- Card principal del evento -->
    <div class="card card-detalle-evento mb-4">
        <div class="card-body">
            <h1 class="card-title">{{ $evento->titulo }}</h1>
            <p class="card-text description-event">{{ $evento->descripcion }}</p>
            <p class="event-date">
                <i class="fa fa-calendar-alt me-1"></i>
                {{ \Carbon\Carbon::parse($evento->fecha)->format('d-m-Y H:i') }}

            </p>
        </div>
        <div class="card-img">
            <img src="{{ asset($evento->img) }}" alt="">
        </div>
    </div>

    <!-- Lotes del evento -->
    <h2 class="mb-3 section-title">Lotes disponibles</h2>
    <div class="row g-4">
        @forelse ($lotes as $lote)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-lote h-100">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">{{ $lote->nombre }}</h3>
                        <p class="card-text flex-grow-1">{{ $lote->descripcion }}</p>
                        <p class="text-lote">Precio: ${{ $lote->precio }}</p>
                        <p class="text-lote">Cantidad: {{ $lote->cantidad }}</p>
                        <div class="mt-3">
                            <a href="{{ route('comprar.lote', $lote->id) }}" class="btn btn-buy w-100">
                                Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-success">
                <p class="fs-5">No hay lotes disponibles para este evento.</p>
            </div>
        @endforelse
    </div>

</div>




@endsection
