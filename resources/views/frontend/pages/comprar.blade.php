@extends('frontend.layouts.master')

@section('title', 'Comprar Entrada')

@section('content')


<div class="container py-5">
    <h2 class="mb-4 text-center text-4xl">Comprar entrada para {{ $evento->titulo }}</h2>

    <!-- Botón volver -->
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-back">
            ← Volver
        </a>
    </div>


    <div class="row g-4">
        <!-- Columna izquierda: Formulario -->
        <div class="col-md-6">
            <div class="card card-form p-4">
                <h4 class="mb-4">Tus datos</h4>

                <form action="{{ route('comprar.guardar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lote_id" value="{{ $lote->id }}">
                    <input type="hidden" name="usuario_id" value="{{ auth()->id() }}">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $user->name }}" placeholder="Juan Pérez" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="juan@gmail.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" name="telefono" id="telefono" class="form-control" value="{{ $user->telefono }}" placeholder="+54 9 11 1234 5678" required>
                    </div>

                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI / Documento</label>
                        <input type="text" name="dni" id="dni" class="form-control" value="{{ $user->dni }}" placeholder="12345678" required>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" max="{{ $lote->cantidad }}" value="1" required>
                    </div>

                    <button type="submit" class="btn-main btn-compra w-100 mt-3">Confirmar compra</button>
                </form>
            </div>
        </div>

        <!-- Columna derecha: Detalle de la entrada -->
        <div class="col-md-6">
            <div class="card card-form shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title">{{ $lote->nombre }}</h4>
                    <p>{{ $lote->descripcion }}</p>
                    <p><strong>Precio unitario:</strong> ${{ $lote->precio }}</p>
                    <p><strong>Disponibles:</strong> {{ $lote->cantidad }}</p>
                </div>
            </div>

            <!-- Métodos de pago debajo del contenedor -->
            <h5 class="mb-3">Elige tu método de pago</h5>

            <div class="metodo-pago-card">
                <input type="radio" name="metodo_pago" id="mp" value="mercadopago" checked>
                <label for="mp" class="d-flex align-items-center w-100">
                    <i class="fa-brands fa-cc-mercadopago"></i> Mercado Pago
                </label>
            </div>
            <!-- <div class="metodo-pago-card">
                <input type="radio" name="metodo_pago" id="paypal" value="paypal">
                <label for="paypal" class="d-flex align-items-center w-100">
                    <i class="fa-brands fa-paypal"></i> PayPal
                </label>
            </div>
            <div class="metodo-pago-card">
                <input type="radio" name="metodo_pago" id="tarjeta" value="tarjeta">
                <label for="tarjeta" class="d-flex align-items-center w-100">
                    <i class="fa-solid fa-credit-card"></i> Tarjeta de crédito/débito
                </label>
            </div> -->
        </div>
    </div>
</div>
@endsection
