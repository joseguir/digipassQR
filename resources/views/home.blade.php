@extends('frontend.layouts.master')

@section('title', 'Eventos Disponibles')

@section('content')
    <div class="home_hero border">
    <!-- <section id="inicio"> -->
        
        <article id="top-page" class="">
            <div class="container">
                <div class="container-wrap-inicio">
                    <div class="left-div presentacion ">
                        <div class="container-titles">

                            <p data-aos="fade-right" data-aos-delay="150" class="subtitle_home">Con DigipassQR, vendé y cobrá al instante.</p>
                            <h2 data-aos="fade-up" 
                            data-aos-delay="250" class="title_home">Vendé tus <span class="text-resaltado">entradas online</span> de forma segura.
                            </h2>
                        </div>
                            <p class=" slogan_home" data-aos="fade-up" 
                            data-aos-delay="350">DigipassQR hace fácil la venta de tickets.</p>
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-qrcode me-2 text-primary"></i>Generá códigos QR únicos para cada entrada</li>
                            <li><i class="fa-solid fa-bolt me-2 text-warning"></i>Ofrecé una experiencia moderna y segura</li>
                            <li><i class="fa-solid fa-circle-check me-2 text-success"></i>Cobrá tus ingresos al momento</li>
                        </ul>

                        <div class="btn-container">
                            <button class="btn-main" data-aos="fade-right" 
                            data-aos-delay="450">Crear cuenta gratis</button>
                            <button class="btn btn-warning">Contáctanos</button>

                        </div>


                    </div>
                    <div class="right-div presentacion-img ">
                        <div class="container-img-inicio  ">
                            <img class="phone-inicio" src="{{ asset('img/phone-inicio.webp') }}" alt="">
                            <div class="phone-box box-1 in-place">
                                <img class="p" src="{{ asset('img/qr_mock.png') }}" alt="">

                            </div>
                            <div class="phone-box box-2 in-place">
                                <img class="" src="{{ asset('img/qr_mock1.jpg') }}" alt="">

                            </div>
                            <div class="phone-box box-3 in-place">
                                <img class="" src="{{ asset('img/qr_mock.webp') }}" alt="">

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
