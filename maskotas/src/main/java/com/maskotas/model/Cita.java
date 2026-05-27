package com.maskotas.model;

import jakarta.persistence.*;
import lombok.Data;
import java.time.LocalDate;

@Entity
@Table(name = "citas")
@Data
public class Cita {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String tipoServicio;
    private LocalDate fechaPreferida;
    private String horaPreferida;
    private String notas;

    private String nombreDueno;
    private String email;
    private String telefono;
    private String nombreMascota;
    private String tipoMascota;

    @Enumerated(EnumType.STRING)
    private EstadoCita estado;

    private String diagnostico;
    private String tratamiento;
    private String notasInternas;

    @ManyToOne
    @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    @ManyToOne
    @JoinColumn(name = "mascota_id")
    private Mascota mascota;

    @ManyToOne
    @JoinColumn(name = "veterinario_id")
    private Usuario veterinario;
}
