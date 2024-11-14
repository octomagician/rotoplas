<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificarCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $contenido, $signedUrl;

    public function __construct(User $user, string $contenido, $signedUrl)
    {
        $this->user = $user;
        $this->contenido = $contenido;
        $this->signedUrl = $signedUrl;
    }

    public function build()
    {
        return $this
        ->subject('Bienvenido')
            ->view('emails.verificar') //nombre del view
            ->with([
                'email' => $this->user->email,
                'username' => $this->user->username,
                'contenido' => $this->contenido,
            ]);    
    }

    public function attachments()
    {
        return [];
    }
}
