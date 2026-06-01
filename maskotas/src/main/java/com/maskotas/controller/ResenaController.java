package com.maskotas.controller;

import com.maskotas.model.Usuario;
import com.maskotas.service.ResenaService;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.web.bind.annotation.*;
import java.util.Map;


@RestController
@RequestMapping("/api/resenas")
public class ResenaController {

    @Autowired
    private ResenaService resenaService;

    @GetMapping("/ultimas")
    public ResponseEntity<?> ultimasResenas() {
        return ResponseEntity.ok(resenaService.findAll().stream().limit(3).map(r -> {
            java.util.Map<String, Object> map = new java.util.HashMap<>();
            map.put("id", r.getId());
            map.put("calificacion", r.getValoracion());
            map.put("comentario", r.getComentario());
            map.put("usuario", r.getUsuario() != null ? Map.of("nombre", r.getUsuario().getNombre()) : Map.of("nombre", "Anónimo"));
            return map;
        }).toList());
    }

    @GetMapping
    public ResponseEntity<?> verResenas() {
        return ResponseEntity.ok(resenaService.findAll().stream().map(r -> {
            java.util.Map<String, Object> map = new java.util.HashMap<>();
            map.put("id", r.getId());
            map.put("calificacion", r.getValoracion());
            map.put("comentario", r.getComentario());
            map.put("usuario", r.getUsuario() != null ? Map.of("nombre", r.getUsuario().getNombre()) : Map.of("nombre", "Anónimo"));
            return map;
        }).toList());
    }

    @PostMapping
    public ResponseEntity<?> guardarResena(@AuthenticationPrincipal Usuario usuario,
                                           @Valid @RequestBody Map<String, Object> request) {
        Integer calificacion = Integer.valueOf(request.get("calificacion").toString());
        String comentario = request.get("comentario").toString();
        resenaService.crearResena(usuario, calificacion, comentario);
        return ResponseEntity.ok(Map.of("success", true, "message", "Reseña publicada"));
    }
}
