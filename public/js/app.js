import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Habilitar Pusher
window.Pusher = Pusher;

// Configurar Laravel Echo con las credenciales de Pusher
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '3a5f088920ee7bf8f9da',  // Reemplaza con tu app_key de Pusher
    cluster: 'us2',     // Reemplaza con tu app_cluster
    forceTLS: true,
});

// Suponiendo que el chat_id es dinámico (lo puedes obtener del frontend)
const chatId = 1;  // Aquí deberías obtener el ID dinámicamente

// Suscribirse al canal de chat en tiempo real
window.Echo.channel('chat.' + chatId)
    .listen('MessageSent', (event) => {
        console.log('Nuevo mensaje:', event);
        
        // Puedes actualizar el DOM para mostrar el nuevo mensaje
        const mensajesDiv = document.getElementById('mensajes');
        const nuevoMensaje = document.createElement('div');
        nuevoMensaje.innerHTML = `<strong>${event.usuario}:</strong> ${event.contenido} <em>(${event.creado_en})</em>`;
        mensajesDiv.appendChild(nuevoMensaje);
    });
