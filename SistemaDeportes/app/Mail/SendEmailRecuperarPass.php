<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailRecuperarPass extends Mailable
{
    use Queueable, SerializesModels;

    public $msj;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje)
    {
        $this->msj = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('direcciondedeportes@unsa.com.ar')
                    ->view('auth.email_recuperar_password.msj_recuperar_password');
    }
}
