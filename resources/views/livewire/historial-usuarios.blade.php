<div class="container py-4">

    @foreach ($historial as $h)

        {{-- ========================= --}}
        {{-- SOLICITUD DE TRANSFERENCIA --}}
        {{-- ========================= --}}
        @if ($h->tipo_accion === 'solicitud_transferencia')
            <div class="alert alert-info historial-alert d-flex flex-column gap-2 px-4 py-3 mb-3 shadow-sm rounded-3">
                <div class="fw-bold">
                    @if ($h->user_id === auth()->id())
                        Solicitud de transferencia enviada a 
                        <span class="text-dark fw-bold">{{ $h->usuario_destino->name }}</span>
                    @else
                        Solicitud de transferencia recibida de 
                        <span class="text-dark fw-bold">{{ $h->user->name }}</span>
                    @endif
                </div>
                <div class="small text-dark">{{ $h->created_at->format('d/m/Y H:i') }}</div>
            </div>
        @endif

        {{-- ========================= --}}
        {{-- TRANSFERENCIA ACEPTADA --}}
        {{-- ========================= --}}
        @if ($h->tipo_accion === 'transferencia_aceptada')
            @if ($h->user_id === auth()->id() && $h->usuario_destino_id != auth()->id())
                <div class="alert alert-success historial-alert d-flex flex-column gap-2 px-4 py-3 mb-3 shadow-sm rounded-3">
                    <div class="fw-bold">Transferencia aceptada. Ya puedes usar tu entrada.</div>
                    <div class="small text-dark">{{ $h->created_at->format('d/m/Y H:i') }}</div>
                </div>
            @elseif ($h->user_id === auth()->id() && $h->usuario_destino_id === auth()->id())
                <div class="alert alert-success historial-alert d-flex flex-column gap-2 px-4 py-3 mb-3 shadow-sm rounded-3">
                    <div class="fw-bold">El receptor aceptó tu transferencia.</div>
                    <div class="small text-dark">{{ $h->created_at->format('d/m/Y H:i') }}</div>
                </div>
            @endif
        @endif

        {{-- ========================= --}}
        {{-- COMPRA DE ENTRADAS --}}
        {{-- ========================= --}}
        @if ($h->tipo_accion === 'compra')
            <div class="alert alert-primary historial-alert d-flex flex-column gap-2 px-4 py-3 mb-3 shadow-sm rounded-3">
                <div class="fw-semibold">
                    Compraste 
                    <span class="fw-bold mx-1">{{ $h->cantidad }}</span>
                    entrada{{ $h->cantidad > 1 ? 's' : '' }} para el evento 
                    <span class="fw-bold ms-1">{{ $h->evento->titulo }}</span>.
                </div>
                <div class="small text-dark">{{ $h->created_at->format('d/m/Y H:i') }}</div>
            </div>
        @endif

    @endforeach

</div>



