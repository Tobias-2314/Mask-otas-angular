package com.maskotas.controller;

import com.maskotas.model.Usuario;
import com.maskotas.service.CitaService;
import com.maskotas.service.MascotaService;
import com.maskotas.service.OrdenService;
import com.maskotas.service.UsuarioService;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.web.bind.annotation.*;
import java.util.Map;
import java.util.HashMap;
import java.util.List;

@RestController
@RequestMapping("/api/usuario")
public class UsuarioController {

    @Autowired
    private UsuarioService usuarioService;

    @Autowired
    private MascotaService mascotaService;

    @Autowired
    private CitaService citaService;

    @Autowired
    private OrdenService ordenService;

    @GetMapping("/mi-cuenta")
    public ResponseEntity<?> miCuenta(@AuthenticationPrincipal Usuario usuario) {
        Map<String, Object> response = new HashMap<>();
        
        Map<String, Object> usuarioMap = new HashMap<>();
        usuarioMap.put("id", usuario.getId());
        usuarioMap.put("nombre", usuario.getNombre());
        usuarioMap.put("email", usuario.getEmail());
        usuarioMap.put("role", usuario.getRole());
        usuarioMap.put("fotoPerfil", usuario.getFotoPerfil());
        response.put("usuario", usuarioMap);

        response.put("mascotas", mascotaService.findByUsuarioId(usuario.getId()).stream().map(m -> {
            Map<String, Object> mm = new HashMap<>();
            mm.put("id", m.getId());
            mm.put("nombre", m.getNombre() != null ? m.getNombre() : "");
            mm.put("tipo", m.getTipo() != null ? m.getTipo() : "");
            mm.put("raza", m.getRaza() != null ? m.getRaza() : "");
            mm.put("genero", m.getGenero() != null ? m.getGenero() : "");
            mm.put("edad", m.getEdad());
            return mm;
        }).toList());

        response.put("citas", citaService.findByUsuarioIdOrderByFechaDesc(usuario.getId()).stream().map(c -> {
            Map<String, Object> cm = new HashMap<>();
            cm.put("id", c.getId());
            cm.put("fechaPreferida", c.getFechaPreferida());
            cm.put("horaPreferida", c.getHoraPreferida() != null ? c.getHoraPreferida() : "");
            cm.put("estado", c.getEstado() != null ? c.getEstado().toString() : "");
            cm.put("tipo", c.getTipoServicio() != null ? c.getTipoServicio() : "");
            cm.put("diagnostico", c.getDiagnostico() != null ? c.getDiagnostico() : "");
            cm.put("tratamiento", c.getTratamiento() != null ? c.getTratamiento() : "");
            cm.put("mascota", c.getMascota() != null ? c.getMascota().getNombre() : c.getNombreMascota());
            return cm;
        }).toList());

        response.put("orders", ordenService.findByUserId(usuario.getId()).stream().map(o -> Map.of(
            "id", o.getId(),
            "total", o.getTotal(),
            "fecha", o.getFecha()
        )).toList());

        return ResponseEntity.ok(response);
    }

    @PutMapping("/actualizar-perfil")
    public ResponseEntity<?> actualizarPerfil(@AuthenticationPrincipal Usuario usuario,
                                              @Valid @RequestBody Map<String, String> request) {
        if (!usuario.getEmail().equals(request.get("email"))
                && usuarioService.existsByEmail(request.get("email"))) {
            return ResponseEntity.badRequest().body(Map.of("error", "El email ya está en uso"));
        }

        usuario.setNombre(request.get("nombre"));
        usuario.setEmail(request.get("email"));
        usuarioService.save(usuario);

        return ResponseEntity.ok(Map.of("success", true, "message", "Perfil actualizado"));
    }

    @PutMapping("/preferencias")
    public ResponseEntity<?> actualizarPreferencias(@AuthenticationPrincipal Usuario usuario,
                                                   @Valid @RequestBody Map<String, String> request) {
        String config = usuario.getConfiguracion();
        Map<String, String> configMap = new HashMap<>();

        if (config != null && !config.isEmpty()) {
            try {
                configMap = new com.fasterxml.jackson.databind.ObjectMapper().readValue(config, Map.class);
            } catch (Exception e) {
                configMap = new HashMap<>();
            }
        }

        if (request.containsKey("theme")) configMap.put("theme", request.get("theme"));
        if (request.containsKey("font_size")) configMap.put("font_size", request.get("font_size"));

        try {
            usuario.setConfiguracion(new com.fasterxml.jackson.databind.ObjectMapper().writeValueAsString(configMap));
        } catch (Exception e) {
            usuario.setConfiguracion("{}");
        }

        usuarioService.save(usuario);
        return ResponseEntity.ok(Map.of("success", true, "message", "Preferencias actualizadas"));
    }
}
