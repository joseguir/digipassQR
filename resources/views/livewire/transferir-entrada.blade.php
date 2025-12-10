<div>
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Transferir entrada #{{ $entradaId }}</h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                    </div>
                   <div class="modal-body">
                            @if ($mensaje)
                                <div class="alert alert-success">{{ $mensaje }}</div>
                            @endif

                            @if ($error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endif

                            <form wire:submit="enviarTransferencia">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        Correo electrónico del destinatario
                                    </label>
                                    <input 
                                        type="email"
                                        id="email"
                                        class="form-control @error('emailReceptor') is-invalid @enderror"
                                        placeholder="ejemplo@correo.com"
                                        wire:model.live.debounce.500ms="emailReceptor"
                                    >
                                    @error('emailReceptor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button 
                                    type="submit"
                                    class="btn btn-primary w-100"
                                    wire:loading.attr="disabled"
                                    wire:target="enviarTransferencia"
                                >
                                    <span wire:loading.remove wire:target="enviarTransferencia">Enviar transferencia</span>
                                    <span wire:loading wire:target="enviarTransferencia">Enviando...</span>
                                </button>
                            </form>

                        </div>

                
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
