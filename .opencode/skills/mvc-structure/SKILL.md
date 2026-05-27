---
name: mvc-structure
description: >
  Estructura de módulos Maven y capas MVC del proyecto Maskotas.
  Usar antes de crear cualquier clase para saber en qué módulo va
  y cómo se llaman los paquetes. Fuente de verdad de la arquitectura.
---

# Estructura MVC — Maskotas

## Módulos Maven

```
maskotas/
├── pom.xml                          ← parent pom
│
├── maskotas-model/                  ← Entidades JPA (@Entity)
│   └── src/main/java/com/maskotas/model/
│       ├── Usuario.java
│       ├── Mascota.java
│       ├── Cita.java
│       ├── HistorialMedico.java
│       ├── Producto.java
│       ├── Orden.java
│       └── Resena.java
│
├── maskotas-repository/             ← Acceso a datos (JpaRepository)
│   └── src/main/java/com/maskotas/repository/
│       ├── UsuarioRepository.java
│       ├── MascotaRepository.java
│       ├── CitaRepository.java
│       └── ...
│
├── maskotas-service/                ← Lógica de negocio (@Service)
│   └── src/main/java/com/maskotas/service/
│       ├── UsuarioService.java
│       ├── MascotaService.java
│       ├── CitaService.java
│       └── ...
│
└── maskotas-controller/             ← Endpoints REST (@RestController)
    └── src/main/java/com/maskotas/controller/
        ├── UsuarioController.java
        ├── MascotaController.java
        ├── CitaController.java
        └── ...
```

## Flujo de una petición

```
HTTP Request
    ↓
@RestController          ← recibe la petición, valida formato
    ↓
@Service                 ← aplica reglas de negocio
    ↓
@Repository              ← consulta la base de datos
    ↓
@Entity                  ← mapea la tabla
```

## Regla de dependencias entre módulos

```
controller → service → repository → model
```

Cada módulo solo conoce al siguiente. El `model` no conoce a nadie.

## Qué va en cada capa

| ¿Qué creo? | Módulo | Anotación |
|-----------|--------|-----------|
| Tabla de BD | `maskotas-model` | `@Entity` |
| Consultas a BD | `maskotas-repository` | `@Repository` / `JpaRepository` |
| Reglas de negocio | `maskotas-service` | `@Service` |
| Endpoint REST | `maskotas-controller` | `@RestController` |
| Respuesta JSON | `maskotas-controller/dto` | sin anotación (record/class) |
