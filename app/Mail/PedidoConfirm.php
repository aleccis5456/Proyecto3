<?php

namespace App\Mail;

use App\Models\Pedido;
use App\Models\ListaPedido;
use App\Models\DatosEnvio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoConfirm extends Mailable
{
    use Queueable, SerializesModels;
    public $listaPedido;
    public $datos;
    public $pedido;
    /**
     * Create a new message instance.
     */
    public function __construct(Pedido $pedido, DatosEnvio $datos, $listaPedido)
    {
        $this->pedido = $pedido;
        $this->listaPedido = $listaPedido;
        $this->datos = $datos;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pedido Confirmado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.pedido',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
