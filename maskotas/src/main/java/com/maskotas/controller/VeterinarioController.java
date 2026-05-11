package com.maskotas.controller;

import com.maskotas.model.Cita;
import com.maskotas.model.Usuario;
import com.maskotas.service.CitaService;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.web.bind.annotation.*;
import java.util.Map;
import com.maskotas.model.EstadoCita;

@RestController
@RequestMapping("/api/veterinario")
@CrossOrigin(origins = "*")
public class VeterinarioController {

    @Autowired
    private CitaService citaService;

    @GetMapping("/dashboard")
    public ResponseEntity<?> dashboard(@AuthenticationPrincipal Usuario usuario) {
        if (!usuario.esVeterinario()) {
            return ResponseEntity.status(403).body(Map.of("error", "Acceso denegado"));
        }

        return ResponseEntity.ok(citaService.findByEstadoInOrderByFechaAsc(
            java.util.Arrays.asList(EstadoCita.PENDIENTE, EstadoCita.CONFIRMADA)
        ).stream().map(c -> Map.of(
            "id", c.getId(),
            "fechaPreferida", c.getFechaPreferida(),
            "horaPreferida", c.getHoraPreferida(),
            "nombreDueno", c.getNombreDueno(),
            "nombreMascota", c.getNombreMascota(),
            "tipo", c.getTipoServicio(),
            "estado", c.getEstado() != null ? c.getEstado().toString() : ""
        )).toList());
    }

    @GetMapping("/citas/{id}")
    public ResponseEntity<?> show(@PathVariable Long id,
                                  @AuthenticationPrincipal Usuario usuario) {
        if (!usuario.esVeterinario()) {
            return ResponseEntity.status(403).body(Map.of("error", "Acceso denegado"));
        }

        Cita cita = citaService.findById(id).orElse(null);
        if (cita == null) return ResponseEntity.notFound().build();

        Map<String, Object> response = new java.util.HashMap<>();
        response.put("id", cita.getId());
        response.put("nombreDueno", cita.getNombreDueno());
        response.put("email", cita.getEmail());
        response.put("telefono", cita.getTelefono());
        response.put("nombreMascota", cita.getNombreMascota());
        response.put("tipoMascota", cita.getTipoMascota());
        response.put("tipoServicio", cita.getTipoServicio());
        response.put("fechaPreferida", cita.getFechaPreferida());
        response.put("horaPreferida", cita.getHoraPreferida());
        response.put("estado", cita.getEstado());
        response.put("diagnostico", cita.getDiagnostico());
        response.put("tratamiento", cita.getTratamiento());
        response.put("notasInternas", cita.getNotasInternas());
        response.put("mascota", cita.getMascota() != null ? Map.of(
            "id", cita.getMascota().getId(),
            "nombre", cita.getMascota().getNombre()
        ) : null);

        return ResponseEntity.ok(response);
    }

    @PatchMapping("/citas/{id}")
    public ResponseEntity<?> update(@PathVariable Long id,
                                    @Valid @RequestBody Map<String, String> request,
                                    @AuthenticationPrincipal Usuario usuario) {
        if (!usuario.esVeterinario()) {
            return ResponseEntity.status(403).body(Map.of("error", "Acceso denegado"));
        }

        Cita cita = citaService.findById(id).orElse(null);
        if (cita == null) return ResponseEntity.notFound().build();

        if (cita.getVeterinario() == null) {
            cita.setVeterinario(usuario);
        }

        if (request.containsKey("diagnostico")) cita.setDiagnostico(request.get("diagnostico"));
        if (request.containsKey("tratamiento")) cita.setTratamiento(request.get("tratamiento"));
        if (request.containsKey("notasInternas")) cita.setNotasInternas(request.get("notasInternas"));
        if (request.containsKey("estado")) cita.setEstado(EstadoCita.valueOf(request.get("estado")));

        citaService.save(cita);
        return ResponseEntity.ok(Map.of("success", true, "message", "Historial clínico actualizado"));
}
}
