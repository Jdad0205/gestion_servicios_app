<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Crea una nueva instancia del evento.
     *
     * @param  Message  $message
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * El canal en el que se transmitirá el evento.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new Channel('chat.' . $this->message->chat_id); // Canal para cada chat
    }

    /**
     * Los datos que se enviarán al frontend.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'usuario' => $this->message->usuario->nombre,
            'contenido' => $this->message->contenido,
            'creado_en' => $this->message->creado_en->toDateTimeString(),
        ];
    }
}
