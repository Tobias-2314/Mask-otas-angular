---
name: service
description: >
  Plantilla para crear Services (@Service) en maskotas-service.
  Usar al crear o modificar lógica de negocio: validaciones de rol,
  filtrado por usuario, asignación de veterinario, cambios de estado de cita.
---

# Skill: Services — maskotas-service

## Plantilla base

```java
// maskotas-service/src/main/java/com/maskotas/service/NombreService.java
package com.maskotas.service;

import com.maskotas.model.NombreEntidad;
import com.maskotas.repository.NombreRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@RequiredArgsConstructor           // inyecta por constructor automáticamente
public class NombreService {

    private final NombreRepository nombreRepository;

    public List<NombreEntidad> listarTodos() {
        return nombreRepository.findAll();
    }

    public NombreEntidad buscarPorId(Long id) {
        return nombreRepository.findById(id)
            .orElseThrow(() -> new RuntimeException("NombreEntidad no encontrada: " + id));
    }

    public NombreEntidad guardar(NombreEntidad entidad) {
        return nombreRepository.save(entidad);
    }

    public void eliminar(Long id) {
        nombreRepository.deleteById(id);
    }
}
```

## Patrones del proyecto — casos reales

### Filtrar por usuario dueño (como en MascotaController original)
```java
// MascotaService.java
public List<Mascota> listarMascotasDeUsuario(Long usuarioId) {
    return mascotaRepository.findByDuenoId(usuarioId);
}

public Mascota guardarParaUsuario(Mascota mascota, Long usuarioId) {
    mascota.setDueno(usuarioRepository.getReferenceById(usuarioId));
    return mascotaRepository.save(mascota);
}
```

### Validación de rol (como en VeterinarioController original)
```java
// CitaService.java
public List<Cita> listarCitasPendientes() {
    return citaRepository.findByEstadoInOrderByFechaPreferidaAsc(
        List.of(EstadoCita.PENDIENTE, EstadoCita.CONFIRMADA)
    );
}

public Cita actualizarDiagnostico(Long citaId, String diagnostico, String tratamiento, Long veterinarioId) {
    Cita cita = buscarPorId(citaId);
    cita.setDiagnostico(diagnostico);
    cita.setTratamiento(tratamiento);
    if (cita.getVeterinario() == null) {
        cita.setVeterinario(usuarioRepository.getReferenceById(veterinarioId));
    }
    return citaRepository.save(cita);
}
```

### Admin — estadísticas del dashboard
```java
// AdminService.java
public DashboardStats obtenerEstadisticas() {
    return new DashboardStats(
        usuarioRepository.count(),
        citaRepository.count(),
        citaRepository.countByEstado(EstadoCita.PENDIENTE),
        resenaRepository.count()
    );
}
```

## Reglas para services

- Máximo 15 líneas por método
- Un método = una sola responsabilidad
- Toda la lógica de negocio aquí — el controller solo llama al service
- Lanzar excepciones con mensaje claro, nunca retornar `null`
- Usar `@RequiredArgsConstructor` — sin `@Autowired`
- `@Transactional` solo en métodos que escriben en BD (guardar, actualizar, eliminar)
