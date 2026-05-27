---
name: api-response
description: >
  Patrones de respuesta JSON para endpoints REST consumidos por Angular.
  Usar al definir DTOs de entrada (Request), DTOs de salida (Response),
  manejo de errores y validaciones. Evita exponer entidades JPA directamente.
---

# Skill: API Response — DTOs y Errores

## Por qué no exponer la entidad directamente

```java
// ❌ Mal — expone campos internos, contraseñas, relaciones circulares
@GetMapping("/mascotas")
public List<Mascota> listar() { ... }

// ✅ Bien — solo los campos que el frontend necesita
@GetMapping("/mascotas")
public List<MascotaResponse> listar() { ... }
```

## DTO de entrada (Request)

```java
// Usar Java Records — simples, inmutables, sin boilerplate
public record MascotaRequest(
    @NotBlank String nombre,
    @NotBlank String tipo,
    String raza,
    @Min(0) Integer edad,
    @DecimalMin("0.0") Double peso,
    String genero,
    String notasMedicas
) {
    public Mascota toEntity() {
        Mascota m = new Mascota();
        m.setNombre(nombre);
        m.setTipo(tipo);
        m.setRaza(raza);
        m.setEdad(edad);
        m.setPeso(peso);
        m.setGenero(genero);
        m.setNotasMedicas(notasMedicas);
        return m;
    }
}
```

## DTO de salida (Response)

```java
// Solo los campos que Angular necesita — sin contraseñas, sin ciclos
public record MascotaResponse(
    Long id,
    String nombre,
    String tipo,
    String raza,
    Integer edad,
    Double peso,
    String genero,
    String notasMedicas,
    String nombreDueno
) {
    public static MascotaResponse from(Mascota mascota) {
        return new MascotaResponse(
            mascota.getId(),
            mascota.getNombre(),
            mascota.getTipo(),
            mascota.getRaza(),
            mascota.getEdad(),
            mascota.getPeso(),
            mascota.getGenero(),
            mascota.getNotasMedicas(),
            mascota.getDueno().getNombre()
        );
    }
}
```

## DTOs reales del proyecto

```java
// CitaResponse — lo que el veterinario ve
public record CitaResponse(
    Long id,
    String tipoServicio,
    LocalDate fechaPreferida,
    String horaPreferida,
    String estado,
    String nombreDueno,
    String emailDueno,
    String nombreMascota,
    String tipoMascota,
    String diagnostico,
    String tratamiento
) {
    public static CitaResponse from(Cita cita) {
        return new CitaResponse(
            cita.getId(),
            cita.getTipoServicio(),
            cita.getFechaPreferida(),
            cita.getHoraPreferida(),
            cita.getEstado().name(),
            cita.getUsuario().getNombre(),
            cita.getUsuario().getEmail(),
            cita.getMascota() != null ? cita.getMascota().getNombre() : cita.getNombreMascota(),
            cita.getMascota() != null ? cita.getMascota().getTipo() : cita.getTipoMascota(),
            cita.getDiagnostico(),
            cita.getTratamiento()
        );
    }
}

// DiagnosticoRequest — lo que el veterinario envía
public record DiagnosticoRequest(
    String diagnostico,
    String tratamiento,
    String notasInternas,
    @NotBlank String estado
) {}

// DashboardStats — estadísticas para admin
public record DashboardStats(
    long totalUsuarios,
    long totalCitas,
    long citasPendientes,
    long totalResenas
) {}
```

## Manejo de errores global

```java
// Un solo lugar para todos los errores — no try/catch en cada controller
@RestControllerAdvice
public class GlobalExceptionHandler {

    @ExceptionHandler(RuntimeException.class)
    public ResponseEntity<ErrorResponse> handleNotFound(RuntimeException ex) {
        return ResponseEntity.status(404).body(new ErrorResponse(ex.getMessage()));
    }

    @ExceptionHandler(MethodArgumentNotValidException.class)
    public ResponseEntity<ErrorResponse> handleValidation(MethodArgumentNotValidException ex) {
        String mensaje = ex.getBindingResult().getFieldErrors().stream()
            .map(e -> e.getField() + ": " + e.getDefaultMessage())
            .collect(Collectors.joining(", "));
        return ResponseEntity.status(400).body(new ErrorResponse(mensaje));
    }

    @ExceptionHandler(AccessDeniedException.class)
    public ResponseEntity<ErrorResponse> handleForbidden(AccessDeniedException ex) {
        return ResponseEntity.status(403).body(new ErrorResponse("Acceso denegado"));
    }
}

public record ErrorResponse(String mensaje) {}
```

## Convención de endpoints para Angular

| Acción | Método | URL | Respuesta |
|--------|--------|-----|-----------|
| Listar todos | `GET` | `/api/mascotas` | `List<MascotaResponse>` |
| Ver las mías | `GET` | `/api/mascotas/mias` | `List<MascotaResponse>` |
| Ver una | `GET` | `/api/mascotas/{id}` | `MascotaResponse` |
| Crear | `POST` | `/api/mascotas` | `MascotaResponse` (201) |
| Actualizar | `PUT` | `/api/mascotas/{id}` | `MascotaResponse` |
| Eliminar | `DELETE` | `/api/mascotas/{id}` | vacío (204) |
| Acción específica | `PUT` | `/api/citas/{id}/confirmar` | estado actualizado |
