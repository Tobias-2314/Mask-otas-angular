---
name: controller
description: >
  Plantilla para crear RestControllers en maskotas-controller exponiendo
  endpoints para el frontend Angular. Usar al crear endpoints nuevos.
  Incluye patrones de autenticación por rol basados en el proyecto real.
---

# Skill: Controllers — maskotas-controller

## Plantilla base

```java
// maskotas-controller/src/main/java/com/maskotas/controller/NombreController.java
package com.maskotas.controller;

import com.maskotas.model.NombreEntidad;
import com.maskotas.service.NombreService;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/nombre")
@RequiredArgsConstructor
public class NombreController {

    private final NombreService nombreService;

    @GetMapping
    public List<NombreEntidad> listar() {
        return nombreService.listarTodos();
    }

    @GetMapping("/{id}")
    public ResponseEntity<NombreEntidad> buscar(@PathVariable Long id) {
        return ResponseEntity.ok(nombreService.buscarPorId(id));
    }

    @PostMapping
    public ResponseEntity<NombreEntidad> crear(@RequestBody @Valid NombreRequest request) {
        NombreEntidad creado = nombreService.guardar(request.toEntity());
        return ResponseEntity.status(201).body(creado);
    }

    @PutMapping("/{id}")
    public ResponseEntity<NombreEntidad> actualizar(@PathVariable Long id, @RequestBody @Valid NombreRequest request) {
        NombreEntidad actualizado = nombreService.actualizar(id, request);
        return ResponseEntity.ok(actualizado);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminar(@PathVariable Long id) {
        nombreService.eliminar(id);
        return ResponseEntity.noContent().build();
    }
}
```

## Endpoints del proyecto — referencia real

### Mascotas (usuario ve las suyas, admin ve todas)
```java
@RestController
@RequestMapping("/api/mascotas")
@RequiredArgsConstructor
public class MascotaController {

    private final MascotaService mascotaService;

    @GetMapping("/mias")                                        // GET /api/mascotas/mias
    public List<Mascota> listarMias(@AuthenticationPrincipal Usuario usuario) {
        return mascotaService.listarMascotasDeUsuario(usuario.getId());
    }

    @PostMapping                                                // POST /api/mascotas
    public ResponseEntity<Mascota> crear(
            @RequestBody @Valid MascotaRequest request,
            @AuthenticationPrincipal Usuario usuario) {
        Mascota creada = mascotaService.guardarParaUsuario(request.toEntity(), usuario.getId());
        return ResponseEntity.status(201).body(creada);
    }

    @DeleteMapping("/{id}")                                     // DELETE /api/mascotas/{id}
    public ResponseEntity<Void> eliminar(
            @PathVariable Long id,
            @AuthenticationPrincipal Usuario usuario) {
        mascotaService.eliminarSiEsDueno(id, usuario.getId());
        return ResponseEntity.noContent().build();
    }
}
```

### Citas veterinario
```java
@RestController
@RequestMapping("/api/veterinario/citas")
@PreAuthorize("hasRole('VETERINARIO')")          // Spring Security — control de rol
@RequiredArgsConstructor
public class CitaVeterinarioController {

    private final CitaService citaService;

    @GetMapping                                              // GET /api/veterinario/citas
    public List<Cita> listarPendientes() {
        return citaService.listarCitasPendientes();
    }

    @GetMapping("/{id}")                                     // GET /api/veterinario/citas/{id}
    public ResponseEntity<Cita> detalle(@PathVariable Long id) {
        return ResponseEntity.ok(citaService.buscarPorId(id));
    }

    @PutMapping("/{id}/diagnostico")                         // PUT /api/veterinario/citas/{id}/diagnostico
    public ResponseEntity<Cita> actualizarDiagnostico(
            @PathVariable Long id,
            @RequestBody @Valid DiagnosticoRequest request,
            @AuthenticationPrincipal Usuario veterinario) {
        Cita actualizada = citaService.actualizarDiagnostico(id, request.diagnostico(), request.tratamiento(), veterinario.getId());
        return ResponseEntity.ok(actualizada);
    }
}
```

### Admin — estadísticas
```java
@RestController
@RequestMapping("/api/admin")
@PreAuthorize("hasRole('ADMIN')")
@RequiredArgsConstructor
public class AdminController {

    private final AdminService adminService;

    @GetMapping("/dashboard")
    public DashboardStats dashboard() {
        return adminService.obtenerEstadisticas();
    }

    @GetMapping("/usuarios")
    public Page<Usuario> listarUsuarios(Pageable pageable) {
        return adminService.listarUsuarios(pageable);
    }
}
```

## Reglas para controllers

- El controller NO tiene lógica — solo recibe, llama al service y devuelve
- Usar `@PreAuthorize` para control de roles — no ifs manuales
- `@AuthenticationPrincipal` para obtener el usuario autenticado
- Siempre `ResponseEntity` cuando el status code importa (201, 204, 404...)
- Para listas simples, retornar `List<T>` directamente — Spring ya devuelve 200
- Los DTOs de entrada (`*Request`) van en el propio módulo controller
