<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transferencia;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;



class NotificacionesUsuario extends Component
{
    public $notificaciones = [];

    public function mount()
    {
        $this->cargarNotificaciones();
    }

    #[On('transferenciaEnviada')]
    public function cargarNotificaciones()
    {
        $this->notificaciones = Auth::user()->unreadNotifications;
    }


    public function aceptar($entradaId, $notificacionId)
    {
          $transferencia = Transferencia::where('entrada_id', $entradaId)
            ->where('receptor_id', Auth::id())
            ->where('estado', 'pendiente')
            ->first();

            if (! $transferencia) {
                session()->flash('error', 'No se encontró la transferencia pendiente.');
                return;
            }

            // Cambiar dueño de la entrada
            $transferencia->entrada->update(['usuario_id' => Auth::id()]);
            $transferencia->update(['estado' => 'aceptada']);

            // Marcar notificación como leída
            Auth::user()->notifications()->where('id', $notificacionId)->update(['read_at' => now()]);

            $this->cargarNotificaciones();
            session()->flash('success', 'Transferencia aceptada correctamente.');
    }

     public function rechazar($entradaId, $notificacionId)
    {
        // Buscar la transferencia pendiente para esta entrada y este usuario
        $transferencia = Transferencia::where('entrada_id', $entradaId)
            ->where('receptor_id', Auth::id())
            ->where('estado', 'pendiente')
            ->first();

        if (! $transferencia) {
            session()->flash('error', 'No se encontró la transferencia pendiente.');
            return;
        }

        // Marcar la transferencia como rechazada
        $transferencia->update(['estado' => 'rechazada']);

        // Marcar la notificación como leída
        Auth::user()->notifications()->where('id', $notificacionId)->update(['read_at' => now()]);

        // Recargar notificaciones en la vista
        $this->cargarNotificaciones();

        session()->flash('success', 'Transferencia rechazada correctamente.');
}



    public function render()
    {
        return view('livewire.notificaciones-usuario');
    }
}
