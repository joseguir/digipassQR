@extends('frontend.layouts.master')

@section('title', 'Eventos Disponibles')

@section('content')
    <div class="home_hero border">
    <!-- <section id="inicio"> -->
        
        <article id="top-page" class="">
            <div class="container">
                <div class="container-wrap-inicio">
                    <div class="left-div presentacion ">
                        <h2 data-aos="fade-right" data-aos-delay="150">Con DigipassQR, vendé y cobrá al instante.</h2>
                        <p data-aos="fade-up" 
                        data-aos-delay="250">Vendé tus entradas online de forma simple y segura.
                        </p>
                        <p class=" presupuesto-text" data-aos="fade-up" 
                        data-aos-delay="350">DigipassQR hace fácil la venta de tickets.</p>
                        <button class="btn btn-main btn-primary" data-aos="fade-right" 
                        data-aos-delay="450">Contáctanos</button>


                    </div>
                    <div class="right-div presentacion-img ">
                        <div class="container-img-inicio  ">
                            <img class="phone-inicio" src="{{ asset('img/phone-inicio.webp') }}" alt="">
                            <div class="phone-box box-1 in-place">
                                <img class="p" src="{{ asset('img/phone-box-1.webp') }}" alt="">

                            </div>
                            <div class="phone-box box-2 in-place">
                                <img class="" src="{{ asset('img/phone-box-3.webp') }}" alt="">

                            </div>
                            <div class="phone-box box-3 in-place">
                                <img class="" src="{{ asset('img/phone-box-2.webp') }}" alt="">

                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </article>
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
    

        <h1 class="text-4xl font-bold  mb-8 text-center sm:text-left ">Eventos</h1>

        <div class="row g-4 container-cards-eventos">
            @forelse ($eventos as $evento)

                    <div class="card card-lote card-evento-poster h-100">
                        <div class="img-container-card">

                            <img src=" {{ asset($evento->img) }} " class="card-img-top" alt="...">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title">{{ $evento->titulo }}</h3>
                            <p class="card-text flex-grow-1">
                                {{ \Illuminate\Support\Str::words($evento->descripcion, 100, '...') }}
                            </p>
                            <p class="text-success">
                                <i class="fa fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($evento->fecha)->format('d-m-Y') }}
                            </p>
                            
                        </div>
                        <div class="mt-3 btn-container">
                            <a href="{{ route('eventoDetalle', $evento->id) }}" class="btn btn-primary w-100">
                                Comprar Entredas
                            </a>
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
