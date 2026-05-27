# Reglas Globales — Maskotas Spring Boot

## Proyecto
Sistema de gestión veterinaria (Maskotas). Entidades principales:
`Usuario`, `Mascota`, `Cita`, `HistorialMedico`, `Producto`, `Orden`, `Resena`.

Roles de usuario: `usuario`, `veterinario`, `admin`.

## Stack
- Java 17 + Spring Boot 3
- Spring Data JPA + MySQL
- Spring Security (JWT para endpoints REST)
- Maven intermodular: `model`, `service`, `repository`, `controller`

## Prioridad absoluta: código simple y legible
- Métodos cortos: máximo 15 líneas
- Un método = una sola cosa
- Nombres en español para entidades del dominio (igual que el proyecto original)
- Sin lógica compleja en controllers — solo llamar al service
- Sin lógica en entities — solo datos y relaciones

## Nunca
- Lógica de negocio en un `@Controller` o `@RestController`
- Queries SQL escritas a mano si JPA puede resolverlo
- Métodos con más de 2 niveles de indentación
- Retornar `null` — usar `Optional<T>` o lanzar excepción clara
