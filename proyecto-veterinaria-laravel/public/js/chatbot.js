// Chatbot MASK!OTAS
document.addEventListener('DOMContentLoaded', function () {
    const chatbotButton = document.getElementById('chatbot-button');
    const chatbotContainer = document.getElementById('chatbot-container');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatbotForm = document.getElementById('chatbot-form');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotMessages = document.getElementById('chatbot-messages');

    // Abrir chatbot
    if (chatbotButton) {
        chatbotButton.addEventListener('click', function () {
            chatbotContainer.classList.remove('hidden');
            chatbotButton.classList.add('hidden');
            chatbotInput.focus();
        });
    }

    // Cerrar chatbot
    if (chatbotClose) {
        chatbotClose.addEventListener('click', function () {
            chatbotContainer.classList.add('hidden');
            chatbotButton.classList.remove('hidden');
        });
    }

    // Enviar mensaje
    if (chatbotForm) {
        chatbotForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const mensaje = chatbotInput.value.trim();
            if (!mensaje) return;

            // Agregar mensaje del usuario
            agregarMensaje(mensaje, 'usuario');
            chatbotInput.value = '';

            // Mostrar indicador de escritura
            const loadingId = mostrarCargando();

            try {
                const response = await fetch('/api/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ mensaje: mensaje })
                });

                const data = await response.json();

                // Eliminar indicador de carga
                eliminarCargando(loadingId);

                if (data.success) {
                    agregarMensaje(data.respuesta, 'bot');
                } else {
                    agregarMensaje('Lo siento, hubo un error. Por favor intenta de nuevo.', 'bot');
                }
            } catch (error) {
                eliminarCargando(loadingId);
                agregarMensaje('Error de conexión. Por favor verifica tu conexión a internet.', 'bot');
            }
        });
    }

    function agregarMensaje(texto, tipo) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex ${tipo === 'usuario' ? 'justify-end' : 'justify-start'} mb-4`;

        const bubbleDiv = document.createElement('div');
        bubbleDiv.className = `max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${tipo === 'usuario'
                ? 'bg-indigo-600 text-white'
                : 'bg-gray-200 text-gray-800'
            }`;
        bubbleDiv.textContent = texto;

        messageDiv.appendChild(bubbleDiv);
        chatbotMessages.appendChild(messageDiv);

        // Scroll al final
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function mostrarCargando() {
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'flex justify-start mb-4';
        loadingDiv.id = 'loading-message';

        loadingDiv.innerHTML = `
            <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg">
                <div class="flex space-x-2">
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>
            </div>
        `;

        chatbotMessages.appendChild(loadingDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

        return 'loading-message';
    }

    function eliminarCargando(id) {
        const loadingElement = document.getElementById(id);
        if (loadingElement) {
            loadingElement.remove();
        }
    }

    // Mensaje de bienvenida
    if (chatbotMessages && chatbotMessages.children.length === 0) {
        agregarMensaje('¡Hola! Soy MaskBot, tu asistente virtual de MASK!OTAS. ¿En qué puedo ayudarte hoy?', 'bot');
    }
});
