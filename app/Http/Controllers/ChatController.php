<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Enviar un mensaje en el chat.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviarMensaje(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'contenido' => 'required|string',
        ]);

        // Crear el mensaje
        $mensaje = Message::create([
            'usuario_id' => auth()->id(),
            'chat_id' => $request->chat_id,
            'contenido' => $request->contenido,
        ]);

        // Emitir el evento MessageSent
        broadcast(new MessageSent($mensaje));

        return response()->json(['mensaje' => $mensaje]);
    }
}
