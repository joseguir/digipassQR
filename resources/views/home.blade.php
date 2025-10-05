@extends('frontend.layouts.master')

@section('title', 'Eventos Disponibles')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
    

        <h1 class="text-4xl font-bold  mb-8 text-center sm:text-left ">Eventos</h1>

        <div class="row g-4">
            @forelse ($eventos as $evento)

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-lote h-100">
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title">{{ $evento->titulo }}</h3>
                            <p class="card-text flex-grow-1">{{ $evento->descripcion }}</p>
                            <p class="text-success">
                                <i class="fa fa-calendar-alt me-1"></i>
                                {{ $evento->fecha }}
                            </p>
                            <div class="mt-3">
                                <a href="{{ route('eventoDetalle', $evento->id) }}" class="btn btn-primary w-100">
                                    Comprar Entredas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center text-success">
                    <p class="fs-5">No hay eventos disponibles por el momento</p>
                </div>
            @endforelse
        </div>

    </div>


    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

@endsection
