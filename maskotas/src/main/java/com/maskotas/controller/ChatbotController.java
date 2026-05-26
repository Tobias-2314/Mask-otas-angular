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
    private static final String MODEL    = "llama-3.1-8b-instant";
    private static final String SYSTEM_PROMPT =
        "Eres el asistente virtual de Maskotas. Responde SIEMPRE en español, de forma breve y directa (máximo 3-4 líneas por respuesta). Sin listas largas. Si la pregunta es simple, responde en 1-2 frases.\n\n" +

        "=== INFORMACIÓN DE LA CLÍNICA ===\n" +
        "Nombre: Maskotas - Clínica Veterinaria\n" +
        "Dirección: Calle Veterinaria 123, Madrid\n" +
        "Teléfono: +34 912 345 678\n" +
        "Email: info@maskotas.com\n" +
        "Web: maskotas.com\n\n" +

        "Horario:\n" +
        "- Lunes a Viernes: 9:00 – 20:00\n" +
        "- Sábado: 10:00 – 14:00\n" +
        "- Domingo: Cerrado\n" +
        "- Urgencias: 24 horas\n\n" +

        "=== SERVICIOS ===\n" +
        "1. Consulta General – chequeos rutinarios y diagnóstico integral.\n" +
        "2. Vacunación – esquema completo de vacunas.\n" +
        "3. Peluquería & Spa – baños, cortes y tratamientos estéticos.\n" +
        "4. Odontología – limpieza dental y salud bucal.\n" +
        "5. Laboratorio – análisis clínicos y diagnóstico por imagen.\n" +
        "6. Cirugía – intervenciones de alta complejidad por especialistas.\n\n" +

        "=== CITAS ===\n" +
        "Los usuarios pueden agendar cita en la sección 'Citas' de la web (requiere cuenta). " +
        "Tipos disponibles: Consulta General, Vacunación, Cirugía, Peluquería. " +
        "Se elige fecha, hora y se indica la mascota.\n\n" +

        "=== TIENDA / PRODUCTOS ===\n" +
        "La web tiene una tienda online con productos para mascotas. " +
        "Los usuarios pueden añadir al carrito y pagar con tarjeta en el checkout.\n\n" +

        "=== MASCOTAS Y CUENTA ===\n" +
        "Cada usuario registrado puede gestionar sus mascotas (nombre, tipo, raza, edad, peso, historial médico) " +
        "desde 'Mi Cuenta'. También puede ver sus citas y pedidos anteriores.\n\n" +

        "=== DATOS DE LA CLÍNICA ===\n" +
        "- Más de 10 años de experiencia\n" +
        "- 2.400+ pacientes tratados\n" +
        "- 98% de clientes satisfechos\n" +
        "- Equipo certificado de veterinarios profesionales\n\n" +

        "=== REGLAS ===\n" +
        "- Si preguntan algo fuera del ámbito veterinario o de la clínica, redirige amablemente.\n" +
        "- Nunca inventes precios concretos de productos o servicios (no están fijados).\n" +
        "- Para urgencias siempre menciona el teléfono: +34 912 345 678.";

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
            "temperature", 0.7
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
