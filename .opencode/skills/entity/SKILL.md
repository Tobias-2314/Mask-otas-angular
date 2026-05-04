---
name: entity
description: >
  Plantilla para crear entidades JPA (@Entity) en el módulo maskotas-model.
  Usar al crear o modificar cualquier clase de datos. Basado en las entidades
  reales del proyecto: Usuario, Mascota, Cita, HistorialMedico.
---

# Skill: Entities — maskotas-model

## Plantilla base

```java
// maskotas-model/src/main/java/com/maskotas/model/NombreEntidad.java
package com.maskotas.model;

import jakarta.persistence.*;
import lombok.Data;
import java.time.LocalDateTime;

@Entity
@Table(name = "nombre_tabla")
@Data                          // getters, setters, equals, hashCode — sin escribirlos a mano
public class NombreEntidad {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false)
    private String campo;

    @Column
    private String campoOpcional;

    @CreationTimestamp
    private LocalDateTime creadoEn;
}
```

## Relaciones — cómo se hacen en este proyecto

```java
// ManyToOne: Mascota tiene un dueño (Usuario)
@ManyToOne(fetch = FetchType.LAZY)
@JoinColumn(name = "usuario_id")
private Usuario dueno;

// OneToMany: Usuario tiene muchas Mascotas
@OneToMany(mappedBy = "dueno", fetch = FetchType.LAZY)
private List<Mascota> mascotas = new ArrayList<>();

// OneToMany: Mascota tiene muchas Citas
@OneToMany(mappedBy = "mascota", fetch = FetchType.LAZY)
private List<Cita> citas = new ArrayList<>();
```

## Entidades del proyecto — referencia rápida

### Usuario
```java
@Entity @Table(name = "usuarios") @Data
public class Usuario {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nombre;
    @Column(unique = true) private String email;
    private String contrasena;
    @Enumerated(EnumType.STRING)
    private RolUsuario role;           // USUARIO, VETERINARIO, ADMIN
    private String fotoPerfil;

    @OneToMany(mappedBy = "dueno") private List<Mascota> mascotas;
    @OneToMany(mappedBy = "usuario") private List<Cita> citas;

    public boolean esAdmin()       { return role == RolUsuario.ADMIN; }
    public boolean esVeterinario() { return role == RolUsuario.VETERINARIO; }
}
```

### Mascota
```java
@Entity @Table(name = "mascotas") @Data
public class Mascota {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nombre;
    private String tipo;          // perro, gato, etc.
    private String raza;
    private Integer edad;
    private Double peso;
    private String genero;
    private String notasMedicas;

    @ManyToOne @JoinColumn(name = "usuario_id")
    private Usuario dueno;

    @OneToMany(mappedBy = "mascota")
    private List<Cita> citas;

    @OneToMany(mappedBy = "mascota")
    private List<HistorialMedico> historial;
}
```

### Cita
```java
@Entity @Table(name = "citas") @Data
public class Cita {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String tipoServicio;
    private LocalDate fechaPreferida;
    private String horaPreferida;
    private String notas;
    @Enumerated(EnumType.STRING)
    private EstadoCita estado;         // PENDIENTE, CONFIRMADA, COMPLETADA, CANCELADA
    private String diagnostico;
    private String tratamiento;
    private String notasInternas;

    @ManyToOne @JoinColumn(name = "usuario_id")   private Usuario usuario;
    @ManyToOne @JoinColumn(name = "mascota_id")   private Mascota mascota;
    @ManyToOne @JoinColumn(name = "veterinario_id") private Usuario veterinario;
}
```

## Reglas para entities

- Solo datos y relaciones — sin lógica de negocio
- Usar `@Data` de Lombok — no escribir getters/setters a mano
- Enums para campos con valores fijos (estado, rol, tipo)
- `fetch = FetchType.LAZY` por defecto en relaciones — carga solo lo necesario
- Sin `@NotNull`, `@Size` en la entidad — esas validaciones van en los DTOs del controller
