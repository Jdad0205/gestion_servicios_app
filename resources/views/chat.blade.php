@extends('layouts.app')

@section('titulo', 'Chat en Vivo')

@section('content')

<style>
  @import url("https://fonts.googleapis.com/css?family=Red+Hat+Display:400,500,900&display=swap");


body, html {
  font-family: Red hat Display, sans-serif;
  font-weight: 400;
  line-height: 1.25em;
  letter-spacing: 0.025em;
  color: #333;
  background: #F7F7F7;
}

.information-bubble {
  margin-left: 20px;
}

#status-online {
  color: green;
}
#status-offline {
  color: red;
}

.form input{
  padding: 10px;
  width: 250px;
  border-radius: 15px;
}


.center {
  display: flex;
  height: 100vh;
  width: 100vw;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.bottom-right {
  position: absolute;
  bottom: 0;
  right: 100px;
}

.pic {
  width: 4rem;
  height: 4rem;
  background-size: cover;
  background-position: center;
  border-radius: 50%;
}

.contact {
  position: relative;
  margin-bottom: 1rem;
  padding-left: 5rem;
  height: 4.5rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.contact .pic {
  position: absolute;
  left: 0;
}
.contact .name {
  font-weight: 500;
  margin-bottom: 0.125rem;
}

.contact .message, .contact .seen {
  font-size: 0.9rem;
  color: #999;
}


.chat {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 24rem;
  height: 38rem;
  z-index: 2;
  box-sizing: border-box;
  border-radius: 1rem;
  background: white;
  box-shadow: 0 0 8rem 0 rgba(0, 0, 0, 0.1), 0rem 2rem 4rem -3rem rgba(0, 0, 0, 0.5);
}

.chat .contact.bar {
  flex-basis: 3.5rem;
  flex-shrink: 0;
  margin: 1rem;
  box-sizing: border-box;
}

.chat .messages {
  padding: 1rem;
  background: #F7F7F7;
  flex-shrink: 2;
  overflow-y: auto;
  min-height: 420px;
  box-shadow: inset 0 2rem 2rem -2rem rgba(0, 0, 0, 0.05), inset 0 -2rem 2rem -2rem rgba(0, 0, 0, 0.05);
}
.chat .messages .time {
  font-size: 0.8rem;
  background: #EEE;
  padding: 0.25rem 1rem;
  border-radius: 2rem;
  color: #999;
  width: -webkit-fit-content;
  width: -moz-fit-content;
  width: fit-content;
  margin: 0 auto;
}
.chat .messages .message {
  box-sizing: border-box;
  padding: 0.5rem 1rem;
  margin: 1rem;
  background: #FFF;
  border-radius: 1.125rem 1.125rem 1.125rem 0;
  min-height: 2.25rem;
  width: -webkit-fit-content;
  width: -moz-fit-content;
  width: fit-content;
  max-width: 66%;
  box-shadow: 0 0 2rem rgba(0, 0, 0, 0.075), 0rem 1rem 1rem -1rem rgba(0, 0, 0, 0.1);
}

.chat .messages .message.incoming {
  margin: 1rem 1rem 1rem auto;
  border-radius: 1.125rem 1.125rem 0 1.125rem;
  background: #333;
  color: white;
}

.chat .messages .message .typing {
  display: inline-block;
  width: 0.8rem;
  height: 0.8rem;
  margin-right: 0rem;
  box-sizing: border-box;
  background: #ccc;
  border-radius: 50%;
}

.chat .messages .message .typing.typing-1 {
  -webkit-animation: typing 3s infinite;
          animation: typing 3s infinite;
}
.chat .messages .message .typing.typing-2 {
  -webkit-animation: typing 3s 250ms infinite;
          animation: typing 3s 250ms infinite;
}
.chat .messages .message .typing.typing-3 {
  -webkit-animation: typing 3s 500ms infinite;
          animation: typing 3s 500ms infinite;
}
.chat .input {
  box-sizing: border-box;
  flex-basis: 4rem;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  padding: 0 0.5rem 0 1.5rem;
}
.chat .input i {
  font-size: 1.5rem;
  margin-right: 1rem;
  color: #666;
  cursor: pointer;
  transition: color 200ms;
}
.chat .input i:hover {
  color: #333;
}
.chat .input input {
  border: none;
  background-image: none;
  background-color: white;
  padding: 0.5rem 1rem;
  margin-right: 1rem;
  border-radius: 1.125rem;
  flex-grow: 2;
  box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1), 0rem 1rem 1rem -1rem rgba(0, 0, 0, 0.2);
  font-family: Red hat Display, sans-serif;
  font-weight: 400;
  letter-spacing: 0.025em;
}
.chat .input input:placeholder {
  color: #999;
}

@-webkit-keyframes typing {
  0%, 75%, 100% {
    transform: translate(0, 0.25rem) scale(0.9);
    opacity: 0.5;
  }
  25% {
    transform: translate(0, -0.25rem) scale(1);
    opacity: 1;
  }
}

@keyframes typing {
  0%, 75%, 100% {
    transform: translate(0, 0.25rem) scale(0.9);
    opacity: 0.5;
  }
  25% {
    transform: translate(0, -0.25rem) scale(1);
    opacity: 1;
  }
}
.pic.stark {
  background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqVg_URh9Mvrm3NYaTlCUyiM7r382ohELc1g&s");
}
</style>
  <h1>Chat en Vivo</h1>


  <!-- Ubicación del chat -->
  <div class="bottom-right">
    <!-- Chat -->
    <div class="chat">

      <!-- Información del contacto -->
      <div class="contact bar">
        <div class="pic stark"></div>
        <div class="name">
        {{ Auth::user()->nombre_usuario }}
        </div>
        <div class="seen" id="last-seen">
        <span id="current-time"></span> <!-- Aquí se insertará la hora actual -->
        </div>
      </div>

      <div class="messages" id="chat">
        <!-- Los mensajes se agregarán aquí dinámicamente -->
      </div>

      <!-- Inputs y Formulario para enviar el mensaje -->
      <form class="input" id="chat-form">
        <input placeholder="Escribe tu mensaje aquí" type="text" id="message-input" />
        <button type="submit">
          <i class="fas fa-paper-plane"></i>
        </button>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

  <script>

function obtenerHoraActual() {
      const fecha = new Date();
      const horas = fecha.getHours().toString().padStart(2, '0');
      const minutos = fecha.getMinutes().toString().padStart(2, '0');
      const segundos = fecha.getSeconds().toString().padStart(2, '0');
      return `${horas}:${minutos}:${segundos}`;
    }

    // Asignar la hora actual al elemento #current-time
    document.getElementById('current-time').textContent = obtenerHoraActual();

    // Opcional: Actualizar la hora cada segundo
    setInterval(function() {
      document.getElementById('current-time').textContent = obtenerHoraActual();
    }, 1000); // Actualiza la hora cada 1000 ms (1 segundo)
    // Escuchar evento de mensajes recibidos
    window.Echo.channel('chat.' + 1) // Cambiar 1 por el ID del chat
      .listen('MessageSent', (event) => {
        console.log('Nuevo mensaje recibido:', event);

        // Mostrar el mensaje recibido en el chat
        const messagesDiv = document.getElementById('chat');
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');
        messageDiv.innerHTML = `<strong>${event.mensaje.usuario_id}:</strong> ${event.mensaje.contenido} <em>(${event.mensaje.created_at})</em>`;
        messagesDiv.appendChild(messageDiv);
      });

    // Enviar mensaje al hacer submit en el formulario
    document.getElementById('chat-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const chatId = 1;  // Este debe ser dinámico, obtén el ID del chat
      const contenido = document.getElementById('message-input').value;

      fetch(`/chat/${chatId}/enviar`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
          contenido: contenido,
          chat_id: chatId,
        }),
      })
      .then(response => response.json())
      .then(data => {
        console.log('Mensaje enviado:', data);
        document.getElementById('message-input').value = '';  // Limpiar el campo de mensaje
      });
    });
  </script>
@endsection
