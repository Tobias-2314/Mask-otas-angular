package com.maskotas.controller;

import org.springframework.beans.factory.annotation.Value;
import org.springframework.http.*;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.client.RestTemplate;

import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/chat")
public class ChatbotController {

    @Value("${groq.api.key}")
    private String groqApiKey;

    private static final String GROQ_URL = "https://api.groq.com/openai/v1/chat/completions";
    private static final String MODEL    = "llama-3.3-70b-versatile";
    private static final String SYSTEM_PROMPT =
        "Eres el asistente virtual de Maskotas. REGLAS ESTRICTAS:\n" +
        "1. Responde SOLO con la información que aparece a continuación. NUNCA inventes datos, números, horarios ni direcciones.\n" +
        "2. Responde en español, máximo 2-3 frases. Sin listas largas.\n" +
        "3. Si no tienes el dato concreto, di que contacten por teléfono o email.\n\n" +

        "DATOS DE LA CLÍNICA (usa EXACTAMENTE estos):\n" +
        "- Nombre: Maskotas - Clínica Veterinaria\n" +
        "- Dirección: Calle Veterinaria 123, Madrid\n" +
        "- Teléfono: +34 912 345 678\n" +
        "- Email: info@maskotas.com\n" +
        "- Horario: Lun-Vie 9:00-20:00 | Sábado 10:00-14:00 | Domingo cerrado | Urgencias 24h\n" +
        "- Experiencia: más de 10 años, 2.400+ pacientes tratados, 98% clientes satisfechos\n\n" +

        "SERVICIOS (exactamente estos 6, sin añadir más):\n" +
        "Consulta General, Vacunación, Peluquería & Spa, Odontología, Laboratorio, Cirugía.\n\n" +

        "CITAS: se agendan online en la sección 'Citas' de la web. Requiere cuenta registrada. " +
        "Tipos: Consulta General, Vacunación, Cirugía, Peluquería.\n\n" +

        "TIENDA: la web tiene tienda online con productos para mascotas, carrito y pago con tarjeta.\n\n" +

        "MI CUENTA: el usuario gestiona sus mascotas, historial médico, citas y pedidos.\n\n" +

        "Si preguntan algo fuera del ámbito veterinario, redirige amablemente hacia los servicios de la clínica.";

    private final RestTemplate restTemplate = new RestTemplate();

    @PostMapping
    public ResponseEntity<?> chat(@RequestBody Map<String, String> body) {
        String userMessage = body.get("message");
        if (userMessage == null || userMessage.isBlank()) {
            return ResponseEntity.badRequest().body(Map.of("error", "Mensaje vacío"));
        }

        HttpHeaders headers = new HttpHeaders();
        headers.setContentType(MediaType.APPLICATION_JSON);
        headers.setBearerAuth(groqApiKey);

        Map<String, Object> requestBody = Map.of(
            "model", MODEL,
            "messages", List.of(
                Map.of("role", "system", "content", SYSTEM_PROMPT),
                Map.of("role", "user",   "content", userMessage)
            ),
            "max_tokens", 200,
            "temperature", 0.3
        );

        try {
            ResponseEntity<Map> groqResponse = restTemplate.exchange(
                GROQ_URL,
                HttpMethod.POST,
                new HttpEntity<>(requestBody, headers),
                Map.class
            );

            @SuppressWarnings("unchecked")
            List<Map<String, Object>> choices =
                (List<Map<String, Object>>) groqResponse.getBody().get("choices");
            @SuppressWarnings("unchecked")
            Map<String, String> message =
                (Map<String, String>) choices.get(0).get("message");

            return ResponseEntity.ok(Map.of(
                "success", true,
                "response", message.get("content")
            ));

        } catch (Exception e) {
            return ResponseEntity.ok(Map.of(
                "success", false,
                "response", "Lo siento, no puedo responder en este momento. " +
                            "Contáctanos en info@maskotas.com o llama al +34 912 345 678."
            ));
        }
    }
}
