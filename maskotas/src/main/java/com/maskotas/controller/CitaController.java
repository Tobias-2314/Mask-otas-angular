package com.maskotas.controller;

import com.maskotas.model.Cita;
import com.maskotas.model.EstadoCita;
import com.maskotas.model.Mascota;
import com.maskotas.model.Usuario;
import com.maskotas.service.CitaService;
import com.maskotas.service.MascotaService;
import com.maskotas.service.UsuarioService;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.web.bind.annotation.*;
import java.util.Map;


@RestController
@RequestMapping("/api/citas")
@CrossOrigin(origins = "*")
public class CitaController {

    @Autowired
    private CitaService citaService;

    @Autowired
    private MascotaService mascotaService;

    @Autowired
    private UsuarioService usuarioService;

    @GetMapping("/ocupadas")
    public ResponseEntity<?> ocupadas() {
        return ResponseEntity.ok(citaService.findOcupadas().stream().map(c -> Map.of(
            "fechaPreferida", c.getFechaPreferida(),
            "horaPreferida", c.getHoraPreferida()
        )).toList());
    }

    @PostMapping
    public ResponseEntity<?> guardarCita(@AuthenticationPrincipal Usuario usuario,
                                         @Valid @RequestBody Cita cita) {
        if (citaService.existeCita(cita.getFechaPreferida(), cita.getHoraPreferida())) {
            return ResponseEntity.badRequest().body(Map.of("error", "Este horario ya está reservado"));
        }

        cita.setUsuario(usuario);
        
        if (cita.getMascota() != null) {
            Mascota mascota = mascotaService.findById(cita.getMascota().getId()).orElse(null);
            if (mascota != null) {
                cita.setNombreMascota(mascota.getNombre());
                cita.setTipoMascota(mascota.getTipo());
            }
        }

        citaService.save(cita);
        return ResponseEntity.ok(Map.of("success", true, "message", "Cita agendada"));
    }

    @GetMapping
    public ResponseEntity<?> misCitas(@AuthenticationPrincipal Usuario usuario) {
        return ResponseEntity.ok(citaService.findByUsuarioIdOrderByFechaDesc(usuario.getId()).stream().map(c -> Map.of(
            "id", c.getId(),
            "fechaPreferida", c.getFechaPreferida(),
            "horaPreferida", c.getHoraPreferida(),
            "estado", c.getEstado() != null ? c.getEstado().toString() : "",
            "tipo", c.getTipoServicio(),
            "mascota", c.getMascota() != null ? c.getMascota().getNombre() : c.getNombreMascota()
        )).toList());
    }

    @PatchMapping("/{id}/estado")
    public ResponseEntity<?> actualizarEstado(@PathVariable Long id,
                                              @RequestBody Map<String, String> body) {
        Cita cita = citaService.findById(id).orElse(null);
        if (cita == null) return ResponseEntity.notFound().build();

        cita.setEstado(EstadoCita.valueOf(body.get("estado")));
        citaService.save(cita);
        return ResponseEntity.ok(Map.of("success", true));
    }

    @GetMapping("/{id}")
    public ResponseEntity<?> verCita(@PathVariable Long id) {
        Cita cita = citaService.findById(id).orElse(null);
        if (cita == null) return ResponseEntity.notFound().build();

        return ResponseEntity.ok(Map.of(
            "id", cita.getId(),
            "nombreDueno", cita.getNombreDueno(),
            "email", cita.getEmail(),
            "telefono", cita.getTelefono(),
            "nombreMascota", cita.getNombreMascota(),
            "tipoMascota", cita.getTipoMascota(),
            "tipoServicio", cita.getTipoServicio(),
            "fechaPreferida", cita.getFechaPreferida(),
            "horaPreferida", cita.getHoraPreferida(),
            "estado", cita.getEstado() != null ? cita.getEstado().toString() : "",
            "diagnostico", cita.getDiagnostico(),
            "tratamiento", cita.getTratamiento(),
            "notasInternas", cita.getNotasInternas()
        ));
    }

    @PutMapping("/{id}")
    public ResponseEntity<?> actualizarCita(@PathVariable Long id,
                                            @Valid @RequestBody Cita cita) {
        Cita existente = citaService.findById(id).orElse(null);
        if (existente == null) return ResponseEntity.notFound().build();

        cita.setId(id);
        citaService.save(cita);
        return ResponseEntity.ok(Map.of("success", true));
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> eliminarCita(@PathVariable Long id) {
        citaService.deleteById(id);
        return ResponseEntity.ok(Map.of("success", true));
    }
}
