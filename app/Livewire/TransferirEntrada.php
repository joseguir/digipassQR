<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Entrada;
use App\Models\Transferencia;
use App\Notifications\TransferenciaRecibida;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use App\Models\HistorialEvento;

use Livewire\Attributes\On;

class TransferirEntrada extends Component
{
     public $entradaId;
    
    #[Validate('required|email|exists:users,email')]
    public $emailReceptor = '';

    public $showModal = false;

    // 🔔 Mensaje reactivo
    public $mensaje = '';
    public $error = '';

    #[On('abrirTransferencia')]
    public function setEntrada($id)
    {
        $this->entradaId = $id;
        $this->showModal = true;
        $this->resetValidation();
        $this->reset(['mensaje', 'error']);
    }

    public function updatedEmailReceptor()
    {
        // Validación reactiva al modificar el campo
        $this->validateOnly('emailReceptor');
    }

    public function enviarTransferencia()
    {
        $this->validate();

        try {
            
        $entrada = Entrada::findOrFail($this->entradaId);
        $receptor = User::where('email', $this->emailReceptor)->firstOrFail();
        $remitente = Auth::user();

        // Validaciones de negocio
        if ($entrada->usuario_id !== $remitente->id) {
            $this->error = 'No puedes transferir una entrada que no te pertenece.';
            return;
        }

        if (Transferencia::where('entrada_id', $entrada->id)->where('estado', 'pendiente')->exists()) {
            $this->error = 'Esta entrada ya tiene una transferencia pendiente.';
            return;
        }

        $eventoId = $entrada->lote->evento_id;

        // Crear transferencia
        Transferencia::create([
            'entrada_id' => $entrada->id,
            'remitente_id' => $remitente->id,
            'receptor_id' => $receptor->id,
            'estado' => 'pendiente',
        ]);

        // registrar solicitud de tranferencia
        HistorialEvento::create([
            'user_id' => $remitente->id,
            'usuario_destino_id' => $receptor->id,
            'evento_id' => $eventoId,
            'cantidad' => 1,
            'tipo_accion' => 'solicitud_transferencia',
        ]);

        $receptor->notify(new TransferenciaRecibida($entrada, $remitente));

        $this->mensaje = 'Transferencia enviada correctamente.';

        // Reset modal y campos
        $this->reset(['emailReceptor', 'entradaId']);
        $this->showModal = false;

        $this->dispatch('transferenciaEnviada');

        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $this->error = 'El email proporcionado no corresponde a un usuario registrado.';
        return;
        } catch (\Exception $e) {
            $this->error = 'Ocurrió un error inesperado al procesar la transferencia.';
            // Opcionalmente, loggear $e
            return;
        }
    }

    public function render()
    {
        return view('livewire.transferir-entrada');
    }
}
