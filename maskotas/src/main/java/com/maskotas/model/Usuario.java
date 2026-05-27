package com.maskotas.model;

import jakarta.persistence.*;
import lombok.Data;
import org.springframework.security.core.GrantedAuthority;
import org.springframework.security.core.authority.SimpleGrantedAuthority;
import org.springframework.security.core.userdetails.UserDetails;
import java.util.Collection;
import java.util.List;

@Entity
@Table(name = "usuarios")
@Data
public class Usuario implements UserDetails {

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

    @Column(columnDefinition = "TEXT")
    private String configuracion;

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

    @Override
    public Collection<? extends GrantedAuthority> getAuthorities() {
        return List.of(new SimpleGrantedAuthority("ROLE_" + (role != null ? role.name() : "USUARIO")));
    }

    @Override
    public String getPassword() {
        return contrasena;
    }

    @Override
    public String getUsername() {
        return email;
    }

    @Override
    public boolean isAccountNonExpired() { return true; }

    @Override
    public boolean isAccountNonLocked() { return true; }

    @Override
    public boolean isCredentialsNonExpired() { return true; }

    @Override
    public boolean isEnabled() { return true; }
}
