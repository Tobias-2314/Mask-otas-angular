package com.maskotas.controller;

import com.maskotas.model.Mascota;
import com.maskotas.model.Usuario;
import com.maskotas.service.MascotaService;
import com.maskotas.service.UsuarioService;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.web.bind.annotation.*;
import java.util.Map;


@RestController
@RequestMapping("/api/mascotas")
@CrossOrigin(origins = "*")
public class MascotaController {

    @Autowired
    private MascotaService mascotaService;

    @Autowired
    private UsuarioService usuarioService;

    @GetMapping
    public ResponseEntity<?> index(@AuthenticationPrincipal Usuario usuario) {
        return ResponseEntity.ok(mascotaService.findByUsuarioId(usuario.getId()).stream().map(m -> Map.of(
            "id", m.getId(),
            "nombre", m.getNombre(),
            "tipo", m.getTipo(),
            "raza", m.getRaza(),
            "edad", m.getEdad()
        )).toList());
    }

    @PostMapping
    public ResponseEntity<?> store(@AuthenticationPrincipal Usuario usuario,
                                    @Valid @RequestBody Mascota mascota) {
        if (usuario.esAdmin() && mascota.getDueno() != null) {
            // Admin can set owner
        } else {
            mascota.setDueno(usuario);
        }

        Mascota saved = mascotaService.save(mascota);
        return ResponseEntity.ok(Map.of("success", true, "id", saved.getId()));
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> destroy(@AuthenticationPrincipal Usuario usuario, @PathVariable Long id) {
        Mascota mascota = mascotaService.findById(id).orElse(null);
        if (mascota == null || !mascota.getDueno().getId().equals(usuario.getId())) {
            return ResponseEntity.status(403).body(Map.of("error", "No autorizado"));
        }
        mascotaService.deleteById(id);
        return ResponseEntity.ok(Map.of("success", true));
    }
}
