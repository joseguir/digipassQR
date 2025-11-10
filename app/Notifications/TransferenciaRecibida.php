<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Entrada;

class TransferenciaRecibida extends Notification
{
    use Queueable;


     protected $entrada;
     protected $remitente;
    /**
     * Create a new notification instance.
     */
    public function __construct(Entrada $entrada, $remitente)
    {
        //
         $this->entrada = $entrada;
        $this->remitente = $remitente;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Se guarda en la tabla notifications
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'mensaje' => "{$this->remitente->name} te ha enviado una entrada para el evento: {$this->entrada->lote->evento->titulo}",
            'entrada_id' => $this->entrada->id,
            'remitente_id' => $this->remitente->id,
        ];
    }
}
