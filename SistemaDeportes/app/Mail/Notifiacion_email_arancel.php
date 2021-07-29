<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

//use App\Usuario;
//use Illuminate\Support\Facades\Mail;
//use App\Mail\Notifiacion_email_arancel;


class Notifiacion_email_arancel extends Mailable
{
    use Queueable, SerializesModels;
    public $subject="Notificación de Vencimiento de Arancel";
    public $datos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo)
    {
        $this->datos=$correo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Notificaciones.Arancel');
    }
}
