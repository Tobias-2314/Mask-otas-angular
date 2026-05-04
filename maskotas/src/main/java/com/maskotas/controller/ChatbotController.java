package com.maskotas.controller;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.Map;

@RestController
@RequestMapping("/api/chat")
@CrossOrigin(origins = "*")
public class ChatbotController {

    @PostMapping
    public ResponseEntity<?> chat(@RequestBody Map<String, String> body) {
        String message = body.get("message");
        return ResponseEntity.ok(Map.of(
            "success", true,
            "response", "Hola, soy el asistente virtual de Maskotas. ¿En qué puedo ayudarte?"
        ));
    }
}
