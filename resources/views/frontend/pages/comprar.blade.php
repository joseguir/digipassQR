@extends('frontend.layouts.master')

@section('title', 'Comprar Entrada')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Comprar entrada para {{ $evento->titulo }}</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title">{{ $lote->nombre }}</h4>
            <p>{{ $lote->descripcion }}</p>
            <p><strong>Precio:</strong> ${{ $lote->precio }}</p>

            <form action="{{ route('comprar.guardar') }}" method="POST">
                @csrf

                <!-- ID del lote -->
                <input type="hidden" name="lote_id" value="{{ $lote->id }}">

                <!-- ID del usuario autenticado -->
                <input type="hidden" name="usuario_id" value="{{ auth()->id() }}">

                

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input 
                        type="number" 
                        name="cantidad" 
                        id="cantidad" 
                        class="form-control" 
                        min="1" 
                        max="{{ $lote->cantidad }}" 
                        value="1" 
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Confirmar compra
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
