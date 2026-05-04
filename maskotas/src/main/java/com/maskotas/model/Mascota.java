package com.maskotas.model;

import jakarta.persistence.*;
import lombok.Data;
import java.util.List;

@Entity
@Table(name = "mascotas")
@Data
public class Mascota {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String nombre;
    private String tipo;
    private String raza;
    private Integer edad;
    private Double peso;
    private String genero;
    private String notasMedicas;

    @ManyToOne
    @JoinColumn(name = "usuario_id")
    private Usuario dueno;

    @OneToMany(mappedBy = "mascota")
    private List<Cita> citas;

    @OneToMany(mappedBy = "mascota")
    private List<HistorialMedico> historial;
}
