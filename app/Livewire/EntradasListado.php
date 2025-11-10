<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Gate;
use App\Models\Entrada;
use Livewire\Component;

class EntradasListado extends Component
{
    public $entradas;

    public function cargarEntradas()
        {
            $user = auth()->user();

            $this->entradas = Entrada::with([
                'lote.evento', 
                'usuario', 
                'estado',
                'transferencias.remitente'
            ])
            ->when($user->role_id == 2, function ($query) use ($user) {
                // Organizador: ver entradas de eventos propios
                $query->whereHas('lote.evento', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
            ->when($user->role_id == 3, function ($query) use ($user) {
                // Cliente: ver solo sus entradas
                $query->where('usuario_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        }
    
   #[On('transferenciaEnviada')]
    public function refrescarEntradas()
    {
        // Livewire detectará el cambio en $this->entradas y volverá a renderizar el componente.
        $this->cargarEntradas(); 
    }

    public function mount()
    {
        $this->cargarEntradas();
    }

   public function abrirTransferencia($entradaId)
    {
        $this->dispatch('abrirTransferencia', id: $entradaId);
    }

    public function render()
    {

        $esAdmin = Gate::allows('admin-or-organizador');

        return view('livewire.entradas-listado', [
            'entradas' => $this->entradas,
            'esAdmin' => $esAdmin,
        ]);
    }
}
