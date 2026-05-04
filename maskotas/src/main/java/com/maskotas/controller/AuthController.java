package com.maskotas.controller;

import com.maskotas.model.Usuario;
import com.maskotas.service.UsuarioService;
import jakarta.servlet.http.HttpSession;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.web.bind.annotation.*;
import java.util.Map;
import java.util.HashMap;

@RestController
@RequestMapping("/api/auth")
@CrossOrigin(origins = "*")
public class AuthController {

    @Autowired
    private UsuarioService usuarioService;

    @Autowired
    private AuthenticationManager authenticationManager;

    @PostMapping("/login")
    public ResponseEntity<?> login(@Valid @RequestBody Map<String, String> request) {
        Authentication authentication = authenticationManager.authenticate(
            new UsernamePasswordAuthenticationToken(request.get("email"), request.get("password"))
        );

        SecurityContextHolder.getContext().setAuthentication(authentication);
        Usuario usuario = (Usuario) authentication.getPrincipal();

        String redirect = "/";
        if (usuario.esAdmin()) redirect = "/admin/dashboard";
        else if (usuario.esVeterinario()) redirect = "/veterinario/dashboard";

        Map<String, Object> response = new HashMap<>();
        response.put("success", true);
        response.put("usuario", Map.of(
            "id", usuario.getId(),
            "nombre", usuario.getNombre(),
            "email", usuario.getEmail(),
            "role", usuario.getRole().toString()
        ));
        response.put("redirect", redirect);
        return ResponseEntity.ok(response);
    }

    @PostMapping("/registro")
    public ResponseEntity<?> registro(@Valid @RequestBody Map<String, String> request) {
        if (!request.get("password").equals(request.get("password_confirmation"))) {
            return ResponseEntity.badRequest().body(Map.of("error", "Las contraseñas no coinciden"));
        }
        if (usuarioService.existsByEmail(request.get("email"))) {
            return ResponseEntity.badRequest().body(Map.of("error", "El email ya está registrado"));
        }

        Usuario usuario = usuarioService.registrar(
            request.get("nombre"), request.get("email"), request.get("password")
        );

        Authentication authentication = authenticationManager.authenticate(
            new UsernamePasswordAuthenticationToken(request.get("email"), request.get("password"))
        );
        SecurityContextHolder.getContext().setAuthentication(authentication);

        return ResponseEntity.ok(Map.of(
            "success", true,
            "usuario", Map.of(
                "id", usuario.getId(),
                "nombre", usuario.getNombre(),
                "email", usuario.getEmail(),
                "role", usuario.getRole().toString()
            )
        ));
    }

    @PostMapping("/logout")
    public ResponseEntity<?> logout(HttpSession session) {
        SecurityContextHolder.clearContext();
        session.invalidate();
        return ResponseEntity.ok(Map.of("success", true));
    }

    @GetMapping("/me")
    public ResponseEntity<?> me(Authentication authentication) {
        if (authentication == null || !authentication.isAuthenticated()) {
            return ResponseEntity.ok(Map.of("authenticated", false));
        }
        Usuario usuario = (Usuario) authentication.getPrincipal();
        return ResponseEntity.ok(Map.of(
            "authenticated", true,
            "usuario", Map.of(
                "id", usuario.getId(),
                "nombre", usuario.getNombre(),
                "email", usuario.getEmail(),
                "role", usuario.getRole().toString(),
                "fotoPerfil", usuario.getFotoPerfil()
            )
        ));
    }
}
