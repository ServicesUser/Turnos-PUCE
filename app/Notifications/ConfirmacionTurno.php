<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Jenssegers\Date\Date;

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
                    ->line('Fecha: '.Date::createFromFormat('Y-m-d', $this->datos->fecha_tu)->format('l, d F Y'))
                    ->line('Hora: '.$this->datos->inicio_tu)
                    ->line($this->datos->horario['responsable']['cubiculo']['detalle_cu'])
                    ->action('Para eliminar reserva',route('turno'),'red')
                    ->line("ZOOM  ".$this->datos->horario['responsable']['cubiculo']['link_cu'])
                    ->salutation('Buen día ');
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
