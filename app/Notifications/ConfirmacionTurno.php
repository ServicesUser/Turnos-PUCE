<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmacionTurno extends Notification
{
    use Queueable;

    public $datos;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        $this->datos=$datos;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hola '.$notifiable->nombres_es)
                    ->line('Se ha registrado su reservación Exitosamente.')
                    ->line('Fecha: '.$this->datos->fecha_tu)
                    ->line('Hora: '.$this->datos->inicio_tu)
                    ->line($this->datos->horario['responsable']['cubiculo']['detalle_cu']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
