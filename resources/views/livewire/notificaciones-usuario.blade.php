<div>
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
             {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

     @forelse ($notificaciones as $n)
        <div class="card mb-2">
            <div class="card-body">
                <p>{{ $n->data['mensaje'] }}</p>
                <div class="d-flex gap-2">
                    <button 
                        type="button"
                        wire:click="aceptar({{ $n->data['entrada_id'] }}, '{{ $n->id }}')" 
                        class="btn btn-success btn-sm">
                        Aceptar
                    </button>
                    <button 
                        type="button"
                        wire:click="rechazar({{ $n->data['entrada_id'] }}, '{{ $n->id }}')" 
                        class="btn btn-danger btn-sm ml-2">
                        Rechazar
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No tienes notificaciones pendientes.</p>
    @endforelse

</div>
