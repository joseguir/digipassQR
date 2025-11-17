@extends('frontend.layouts.master')

@section('title', 'Factura de Compra')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 style="font-size: 48px; font-weight: 800;">DigiPassQR</h1>
        <p class="text-muted">Comprobante de compra</p>
    </div>

    <div id="factura" class="card p-4 shadow">
        <h3 class="mb-3">{{ $evento->titulo }}</h3>

        <p><strong>Comprador:</strong> {{ $usuario->name }}</p>
        <p><strong>Email:</strong> {{ $usuario->email }}</p>

        <hr>

        <p><strong>Entrada:</strong> {{ $lote->nombre }}</p>
        <p><strong>Precio unitario:</strong> ${{ $lote->precio }}</p>
        <p><strong>Cantidad comprada:</strong> {{ $entradas->count() }}</p>

        <p class="mt-3" style="font-size:20px;">
            <strong>Total pagado:</strong> ${{ $entradas->count() * $lote->precio }}
        </p>

        <hr>

        <h5 class="mt-3">Entradas generadas</h5>

        <ul>
            @foreach($entradas as $e)
                <li>ID Entrada #{{ $e->id }} — Código QR: {{ $e->codigo_qr }}</li>
            @endforeach
        </ul>

        <hr>

        <p class="text-center text-muted">Gracias por tu compra con DigiPassQR</p>
    </div>

    <div class="mt-4 d-flex gap-3">

        <button class="btn btn-primary" onclick="descargarPDF()">
            Descargar factura en PDF
        </button>

        <a href="{{ route('entradas.index') }}" class="btn btn-success">
            Ver mis entradas
        </a>

    </div>
</div>


<script>
function descargarPDF() {
    const element = document.getElementById('factura');

    html2pdf()
        .from(element)
        .set({
            margin: 10,
            filename: 'factura-digipassqr.pdf',
            jsPDF: { unit: 'mm', format: 'a4' }
        })
        .save();
}
</script>

@endsection
