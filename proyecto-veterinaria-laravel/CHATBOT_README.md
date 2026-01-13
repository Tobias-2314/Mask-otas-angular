# 🤖 Documentación del Chatbot MASK!OTAS

## 1. Descripción General
El chatbot de MASK!OTAS es un asistente virtual integrado en la plataforma web diseñado para responder preguntas frecuentes de los clientes sobre servicios, horarios y cuidados básicos de mascotas. 

Utiliza **Inteligencia Artificial Generativa** para procesar el lenguaje natural y ofrecer respuestas contextualizadas y amables.

## 2. Arquitectura Técnica

### 🌍 Proveedor de IA
- **Proveedor Actual:** [Groq](https://groq.com/) (Anteriormente Google Gemini).
- **Modelo:** `llama-3.3-70b-versatile`.
- **Razón del cambio:** Groq ofrece una latencia extremadamente baja y actualmente tiene límites de uso gratuitos más generosos que Gemini para este nivel de tráfico.
- **Formato de API:** Compatible con OpenAI (Chat Completions API).

### 🖥️ Backend (Laravel)
- **Controlador:** `App\Http\Controllers\Api\AiChatController`
- **Ruta:** `POST /api/chat`
- **Lógica:**
    1.  Recibe el mensaje del usuario.
    2.  Valida que no esté vacío.
    3.  Construye un prompt de sistema ("System Prompt") que define la personalidad del bot (Asistente veterinario, respuestas breves).
    4.  Envía la petición a Groq via HTTP Client.
    5.  Devuelve la respuesta en formato JSON.

### 🎨 Frontend (Angular)
- **Componente:** `ChatbotComponent` (`src/app/shared/components/chatbot`)
    - **Tipo:** Standalone Component.
    - **Características:** Botón flotante, ventana modal, animaciones de entrada/salida, scroll automático.
- **Servicio:** `ChatService` (`src/app/core/services/chat.service.ts`)
    - Se encarga de la comunicación HTTP con el backend.

## 3. Configuración e Instalación

### Requisitos Previos
- PHP 8.1+
- Composer
- Cuenta en [Groq Cloud](https://console.groq.com/).

### Pasos de Configuración en Backend
1.  Obtener una API Key en la consola de Groq.
2.  Abrir el archivo `.env` en la raíz de `proyecto-veterinaria-laravel`.
3.  Agregar la siguiente variable:
    ```ini
    GROQ_API_KEY=gsk_tu_clave_secreta_aqui...
    ```
4.  Limpiar la caché de configuración:
    ```bash
    php artisan config:clear
    ```

## 4. Estructura de Archivos Clave

| Archivo | Descripción |
| :--- | :--- |
| `app/Http/Controllers/Api/AiChatController.php` | Lógica principal. Define el modelo y el "System Prompt". |
| `routes/api.php` | Define la ruta pública `Route::post('/chat', ...)` |
| `src/app/shared/components/chatbot/chatbot.component.ts` | Lógica de interfaz (abrir/cerrar, enviar mensajes, loading). |
| `src/app/shared/components/chatbot/chatbot.component.css` | Estilos responsivos y animaciones del chat. |

## 5. Personalización del Comportamiento

Para cambiar cómo responde el bot (por ejemplo, para hacerlo más serio o más divertido), edita la variable `$systemContext` en `AiChatController.php`:

```php
$systemContext = "Eres el asistente virtual... Tus respuestas deben ser MUY BREVES...";
```

## 6. Solución de Problemas Comunes (Troubleshooting)

### Error 500 / "Internal Server Error"
- **Causa:** Generalmente falta la API Key o hay un error de sintaxis en el código.
- **Solución:** Revisa los logs en `storage/logs/laravel.log`.

### Error 429 "Too Many Requests" o "Quota Exceeded"
- **Causa:** Has superado el límite de peticiones gratuitas de Groq (o del proveedor en uso).
- **Solución:** Esperar unos minutos o cambiar a un modelo más ligero (ej. `llama-3.1-8b-instant`).

### Respuestas "Lo siento, tuve un problema..."
- **Causa:** Error de conexión entre Laravel y la API de IA (timeout o DNS).
- **Solución:** Verifica tu conexión a internet y que `GROQ_API_KEY` sea correcta.

### Error de Certificado SSL (cURL error 60)
- **Causa:** Entorno de desarrollo local (Windows/XAMPP/Laragon) sin certificados actualizados.
- **Solución:** En desarrollo, usamos `'verify' => false` en el cliente HTTP. En producción, asegúrate de tener los certificados CA actualizados.

---
**Desarrollado para:** MASK!OTAS Clínica Veterinaria
**Fecha de actualización:** Enero 2026
