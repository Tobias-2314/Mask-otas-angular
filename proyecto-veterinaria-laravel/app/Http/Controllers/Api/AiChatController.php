<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Forzamos la lectura del .env si es necesario (aunque en prod no se debe hacer, en dev ayuda)
        $apiKey = env('GROQ_API_KEY');
        
        Log::info('Chat Request. API Key length: ' . strlen($apiKey ?? ''));

        if (!$apiKey) {
            Log::error('GROQ_API_KEY Missing in .env');
            return response()->json([
                'error' => 'La configuración de IA no está completa. Contacte al administrador.'
            ], 500);
        }

        $userMessage = $request->input('message');

        try {
            // URL de la API de Groq
            $url = "https://api.groq.com/openai/v1/chat/completions";

            // Contexto del sistema para que actúe como asistente veterinario
            $systemContext = "Eres el asistente virtual de la clínica veterinaria MASK!OTAS. Ayudas a los clientes con información sobre nuestros servicios (consulta, vacunación, peluquería, emergencias), horarios y consejos básicos de cuidado animal. IMPORTANTE: Tus respuestas deben ser MUY BREVES Y CONCISAS (máximo 2-3 oraciones). Ve directo al grano. Sé amable pero no te extiendas innecesariamente. Si te preguntan algo fuera del tema veterinario, indica amablemente que solo puedes responder sobre mascotas y la clínica.";

            $response = Http::withOptions([
                'verify' => false,
            ])->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey,
            ])->post($url, [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => $systemContext],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'temperature' => 0.7
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Extraer el texto de la respuesta de Groq (formato OpenAI)
                $botReply = $data['choices'][0]['message']['content'] ?? 'Lo siento, no pude procesar tu solicitud.';

                return response()->json([
                    'reply' => $botReply
                ]);
            } else {
                Log::error('Groq API Error: ' . $response->body());
                return response()->json([
                    'error' => 'Error al comunicarse con el servicio de IA.',
                    'details' => $response->json()
                ], $response->status());
            }

        } catch (\Exception $e) {
            Log::error('Chatbot Exception: ' . $e->getMessage());
            return response()->json([
                'error' => 'Ocurrió un error interno.'
            ], 500);
        }
    }
}
