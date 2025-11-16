<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\HistorialEvento;

class HistorialUsuarios extends Component
{
    public $historial;

    public function mount($historial = null)
    {
         $user = Auth::user();

      // Cliente
        if ($user->role_id === 3) { 
            $this->historial = HistorialEvento::where('user_id', $user->id)
            ->orWhere('usuario_destino_id', $user->id)
            ->with('user', 'usuario_destino', 'evento')
            ->orderBy('created_at', 'desc')
            ->get();

        }

        // Organizador
        if ($user->role_id === 2) { 
            $this->historial = HistorialEvento::whereHas('evento', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->with('user', 'usuario_destino', 'evento')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        
    }
    public function render()
    {
        return view('livewire.historial-usuarios');
    }
}
