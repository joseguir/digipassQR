<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transferencia;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\HistorialEvento;





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

         try {
            DB::beginTransaction();

        
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

           // 1) Registrar historial para la transferencia

                HistorialEvento::create([
                    'user_id'            => Auth::id(),                 // receptor (quien aceptó y la recibe)
                    'usuario_destino_id' => $transferencia->remitente_id, // remitente (quien la envió)
                    'entrada_id'         => $entradaId,
                    'evento_id'          => $transferencia->entrada->lote->evento_id,
                    'tipo_accion'        => 'transferencia_aceptada',
                    'descripcion'        => 'Has recibido una entrada de ' . $transferencia->remitente->name,
                ]);
            // Marcar notificación como leída
             Auth::user()->notifications()->where('id', $notificacionId)->update(['read_at' => now()]);

             DB::commit();
            
            
            $this->cargarNotificaciones();
            session()->flash('success', 'Transferencia aceptada correctamente.');

              } catch (\Throwable $e) {

                DB::rollBack();

                dd($e->getMessage(), $e->getTraceAsString());

                \Log::error('Error al aceptar transferencia: ' . $e->getMessage());

                session()->flash('error', 'Ocurrió un error al procesar la transferencia.');
            }
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
