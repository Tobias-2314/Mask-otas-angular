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
@CrossOrigin(origins = "*")
public class ResenaController {

    @Autowired
    private ResenaService resenaService;

    @GetMapping("/ultimas")
    public ResponseEntity<?> ultimasResenas() {
        return ResponseEntity.ok(resenaService.findAll().stream().limit(3).map(r -> Map.of(
            "id", r.getId(),
            "calificacion", r.getValoracion(),
            "comentario", r.getComentario(),
            "usuario", Map.of("nombre", r.getUsuario().getNombre())
        )).toList());
    }

    @GetMapping
    public ResponseEntity<?> verResenas() {
        return ResponseEntity.ok(resenaService.findAll().stream().map(r -> Map.of(
            "id", r.getId(),
            "calificacion", r.getValoracion(),
            "comentario", r.getComentario(),
            "usuario", Map.of("nombre", r.getUsuario().getNombre())
        )).toList());
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
