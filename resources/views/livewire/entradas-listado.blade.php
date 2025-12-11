<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

     @if ($esAdmin)
        <!-- TABLA -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Lote</th>
                    <th>Usuario</th>
                    <!-- <th>Estado</th> -->
                    <th>Estado</th>
                    <th>Código QR</th>
                    <th>Fecha Compra</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entradas as $entrada)
                    <tr>
                        <td>{{ $entrada->id }}</td>
                        <td>{{ $entrada->lote->evento->titulo }}</td>
                        <td>{{ $entrada->lote->nombre }}</td>
                        <td>{{ $entrada->usuario->name }}</td>
                        <!-- <td>{{-- $entrada->estado->nombre --}}</td> -->
                        <td>
                            <span class="badge {{ $entrada->is_used ? 'bg-success' : 'bg-secondary' }}">
                                {{ $entrada->is_used ? 'Usada' : 'No usada' }}
                            </span>
                        </td>

                        <td>{{ $entrada->codigo_qr }}</td> 
                        <td>{{ $entrada->fecha_compra }}</td>
                        <td>
                            <a href="{{ route('entradas.show', $entrada) }}" class="btn btn-info btn-sm">Ver Entrada</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <!-- CARDS -->
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
        @foreach ($entradas as $entrada)
            <div class="col mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header text-white text-center fw-semibold"
                        style="background: linear-gradient(90deg, #0d6efd, #013a8b);">
                        {{ $entrada->lote->evento->titulo }}
                    </div>

                    <div class="card-body">
                        <p class="mb-2"><strong>Id:</strong> {{ $entrada->id }}</p>
                        <p class="mb-2"><strong>Lote:</strong> {{ $entrada->lote->nombre }}</p>
                        <p class="mb-2"><strong>Estado:</strong> {{ $entrada->estado->nombre ?? '—' }}</p>
                        <p class="mb-2">
                            <strong>Fecha compra:</strong>
                              {{ \Carbon\Carbon::parse($entrada->fecha_compra)->locale('es')->translatedFormat('j \d\e F Y') }}
                        </p>
                        @if($entrada->transferencias->isNotEmpty())
                            <p class="mb-2">
                                <strong>Enviado por:</strong> 
                                <span style="display: inline-block; min-width: 120px; height: 1.5em;">
                                    {{ $entrada->transferencias->last()?->remitente?->name ?? '' }}
                                </span>
                            </p>
                        @else
                            <span style="visibility: hidden;">Placeholder</span>
                        @endif

                          @php
                            $transferenciaPendiente = $entrada->transferencias->where('estado', 'pendiente')->first();
                          @endphp


                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('entradas.show', $entrada) }}" 
                                class="btn btn-outline-primary flex-grow-1">
                                Ver entrada
                            </a>
                            <button 
                                    wire:click="abrirTransferencia({{ $entrada->id }})"
                                    class="btn btn-outline-secondary flex-grow-1 ml-2"
                                    @if($transferenciaPendiente) disabled @endif
                                >
                                    {{ $transferenciaPendiente ? 'Transfiriendo...' : 'Transferir' }}
                                </button>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

{{--  Solo un componente de transferencia (fuera del foreach) --}}
<livewire:transferir-entrada />


    
    @endif
</div>
