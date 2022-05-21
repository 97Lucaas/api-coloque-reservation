<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $full_name = $this->invitation->full_name();

        $event_name = $this->invitation->event_appartenance->title;

        return $this->markdown('vendor.notifications.invitation')
            ->subject("Votre ticket pour $event_name")
            ->with('key',$this->invitation->key)
            ->with('introLines', [
                "Bonjour **$full_name**, voici votre billet pour **$event_name**,",
                "nous vous le demanderons le jour de l'évènement."
            ])
        ;
    }
}
