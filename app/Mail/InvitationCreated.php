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
        return $this->markdown('vendor.notifications.invitation')
            ->subject("Votre ticket MMI Bordeaux")
            ->with('key',$this->invitation->key)
            ->with('introLines', [
                "Bonjour **$full_name**, voici votre billet,",
                "nous vous le demanderons le jour du colloque."
            ])
        ;
    }
}
