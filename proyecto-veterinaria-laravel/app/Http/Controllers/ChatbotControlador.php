<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotControlador extends Controller
{
    public function chat(Request $request)
    {
        \Log::info('Chatbot request received', ['mensaje' => $request->all()]);
        
        $request->validate([
            'mensaje' => 'required|string|max:500'
        ]);

        $mensaje = $request->mensaje;
        $apiKey = env('GROQ_API_KEY');
        
        \Log::info('API Key present: ' . (!empty($apiKey) ? 'Yes' : 'No'));

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres MaskBot, asistente de la clínica veterinaria MASK!OTAS. Responde de forma BREVE y DIRECTA (máximo 2-3 oraciones). Sé amable pero conciso. Si preguntan por citas, menciona el sistema en línea. Responde en español.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $mensaje
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 200,
            ]);
            
            \Log::info('Groq API response status: ' . $response->status());

            if ($response->successful()) {
                $data = $response->json();
                $respuesta = $data['choices'][0]['message']['content'] ?? 'Lo siento, no pude procesar tu mensaje.';
                
                return response()->json([
                    'success' => true,
                    'respuesta' => $respuesta
                ]);
            } else {
                \Log::error('Groq API error', ['response' => $response->body()]);
                return response()->json([
                    'success' => false,
                    'error' => 'Error al comunicarse con el servicio de IA: ' . $response->body()
                ], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Chatbot exception', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
