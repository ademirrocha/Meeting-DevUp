<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\supo;

use App\Models\Reunioes;

use Illuminate\Support\Facades\Mail;

class ReuniaoNotify extends Notification
{
    use Queueable;

    private $reuniao;
    private $pautas;
    private $usuario;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reunioes $reuniao, $pautas, $usuario)
    {
        $this->reuniao = $reuniao;
        $this->pautas = $pautas;
        $this->usuario = $usuario;
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
                    ->subject("Nova Reunião: {$this->reuniao->title}")
                    ->line("Pautas: {$this->pautas[0]->nome}")
                    ->action('Confirmar Presença', url("reuniao/{$this->reuniao->id}/confirmar_presenca/{$this->usuario}/confirm"))
                    ->line('Obrigado por usar o Meeting');
                    
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
