package com.maskotas.model;

import jakarta.persistence.*;
import lombok.Data;
import java.util.List;

@Entity
@Table(name = "usuarios")
@Data
public class Usuario {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String nombre;

    @Column(unique = true)
    private String email;

    private String contrasena;

    @Enumerated(EnumType.STRING)
    private RolUsuario role;

    private String fotoPerfil;

    @OneToMany(mappedBy = "dueno")
    private List<Mascota> mascotas;

    @OneToMany(mappedBy = "usuario")
    private List<Cita> citas;

    public boolean esAdmin() {
        return role == RolUsuario.ADMIN;
    }

    public boolean esVeterinario() {
        return role == RolUsuario.VETERINARIO;
    }
}
