package com.maskotas.controller;

import com.maskotas.model.*;
import com.maskotas.service.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.*;

@RestController
@RequestMapping("/api/admin")
public class AdminController {

    @Autowired private UsuarioService usuarioService;
    @Autowired private CitaService citaService;
    @Autowired private ResenaService resenaService;
    @Autowired private ProductoService productoService;
    @Autowired private MascotaService mascotaService;
    @Autowired private HistorialMedicoService historialMedicoService;
    @Autowired private OrdenService ordenService;

    @GetMapping("/dashboard")
    public ResponseEntity<?> dashboard(@RequestParam(defaultValue = "30") int range) {
        long totalUsuarios = usuarioService.findAll().size();
        long totalCitas = citaService.findOcupadas().size();
        long totalResenas = resenaService.findAll().size();
        long citasPendientes = citaService.findByEstadoInOrderByFechaAsc(Arrays.asList(EstadoCita.PENDIENTE)).size();

        LocalDateTime since = LocalDateTime.now().minusDays(range);
        var sales = ordenService.findCompletedSince(since);

        List<Map<String, Object>> salesList = new ArrayList<>();
        for (var o : sales) {
            Map<String, Object> m = new HashMap<>();
            m.put("date", o.getFecha().toLocalDate());
            m.put("total", o.getTotal());
            salesList.add(m);
        }

        Map<String, Object> response = new HashMap<>();
        response.put("totalUsuarios", totalUsuarios);
        response.put("totalCitas", totalCitas);
        response.put("totalResenas", totalResenas);
        response.put("citasPendientes", citasPendientes);
        response.put("sales", salesList);

        return ResponseEntity.ok(response);
    }

    @GetMapping("/usuarios")
    public ResponseEntity<?> usuarios() {
        List<Map<String, Object>> result = new ArrayList<>();
        for (Usuario u : usuarioService.findAll()) {
            Map<String, Object> m = new HashMap<>();
            m.put("id", u.getId());
            m.put("nombre", u.getNombre());
            m.put("email", u.getEmail());
            m.put("role", u.getRole() != null ? u.getRole().toString() : "");
            result.add(m);
        }
        return ResponseEntity.ok(result);
    }

    @PostMapping("/usuarios")
    public ResponseEntity<?> guardarUsuario(@RequestBody Usuario usuario) {
        if (usuarioService.existsByEmail(usuario.getEmail())) {
            return ResponseEntity.badRequest().body(Map.of("error", "El email ya existe"));
        }
        Usuario saved = usuarioService.save(usuario);
        return ResponseEntity.ok(Map.of("success", true, "id", saved.getId()));
    }

    @DeleteMapping("/usuarios/{id}")
    public ResponseEntity<?> eliminarUsuario(@PathVariable Long id) {
        usuarioService.deleteById(id);
        return ResponseEntity.ok(Map.of("success", true));
    }

    @GetMapping("/citas")
    public ResponseEntity<?> citas() {
        List<Map<String, Object>> result = new ArrayList<>();
        for (Cita c : citaService.findByEstadoInOrderByFechaAsc(new ArrayList<>())) {
            Map<String, Object> m = new HashMap<>();
            m.put("id", c.getId());
            m.put("fechaPreferida", c.getFechaPreferida());
            m.put("nombreDueno", c.getNombreDueno() != null ? c.getNombreDueno() : "");
            m.put("estado", c.getEstado() != null ? c.getEstado().toString() : "");
            m.put("tipo", c.getTipoServicio() != null ? c.getTipoServicio() : "");
            m.put("usuario", c.getUsuario() != null ? c.getUsuario().getNombre() : "");
            result.add(m);
        }
        return ResponseEntity.ok(result);
    }

    @GetMapping("/resenas")
    public ResponseEntity<?> resenas() {
        List<Map<String, Object>> result = new ArrayList<>();
        for (Resena r : resenaService.findAll()) {
            Map<String, Object> m = new HashMap<>();
            m.put("id", r.getId());
            m.put("calificacion", r.getValoracion());
            m.put("comentario", r.getComentario());
            m.put("usuario", r.getUsuario().getNombre());
            result.add(m);
        }
        return ResponseEntity.ok(result);
    }

    @DeleteMapping("/resenas/{id}")
    public ResponseEntity<?> eliminarResena(@PathVariable Long id) {
        resenaService.deleteById(id);
        return ResponseEntity.ok(Map.of("success", true));
    }

    @GetMapping("/productos")
    public ResponseEntity<?> productos() {
        List<Map<String, Object>> result = new ArrayList<>();
        for (Producto p : productoService.findAll()) {
            Map<String, Object> m = new HashMap<>();
            m.put("id", p.getId());
            m.put("name", p.getNombre());
            m.put("price", p.getPrecio());
            m.put("stock", p.getStock());
            result.add(m);
        }
        return ResponseEntity.ok(result);
    }

    @PostMapping("/productos")
    public ResponseEntity<?> guardarProducto(@RequestBody Producto producto) {
        Producto saved = productoService.save(producto);
        return ResponseEntity.ok(Map.of("success", true, "id", saved.getId()));
    }

    @PutMapping("/productos/{id}")
    public ResponseEntity<?> actualizarProducto(@PathVariable long id, @RequestBody Producto producto) {
        producto.setId(id);
        productoService.save(producto);
        return ResponseEntity.ok(Map.of("success", true));
    }

    @DeleteMapping("/productos/{id}")
    public ResponseEntity<?> eliminarProducto(@PathVariable Long id) {
        productoService.deleteById(id);
        return ResponseEntity.ok(Map.of("success", true));
    }

    @GetMapping("/mascotas")
    public ResponseEntity<?> mascotas(@RequestParam(required = false) String search) {
        List<Map<String, Object>> result = new ArrayList<>();
        for (Mascota m : mascotaService.search(search)) {
            Map<String, Object> map = new HashMap<>();
            map.put("id", m.getId());
            map.put("nombre", m.getNombre());
            map.put("tipo", m.getTipo());
            map.put("dueno", m.getDueno() != null ? m.getDueno().getNombre() : "");
            result.add(map);
        }
        return ResponseEntity.ok(result);
    }

    @GetMapping("/mascotas/{id}")
    public ResponseEntity<?> verMascota(@PathVariable Long id) {
        Mascota mascota = mascotaService.findById(id).orElse(null);
        if (mascota == null) return ResponseEntity.notFound().build();

        List<Map<String, Object>> historialList = new ArrayList<>();
        for (HistorialMedico h : historialMedicoService.findByMascotaId(id)) {
            Map<String, Object> hm = new HashMap<>();
            hm.put("id", h.getId());
            hm.put("tipo", h.getTipo());
            hm.put("descripcion", h.getDescripcion());
            hm.put("fecha", h.getFecha());
            historialList.add(hm);
        }

        Map<String, Object> response = new HashMap<>();
        response.put("id", mascota.getId());
        response.put("nombre", mascota.getNombre());
        response.put("tipo", mascota.getTipo());
        response.put("raza", mascota.getRaza());
        response.put("dueno", mascota.getDueno() != null ? Map.of("id", mascota.getDueno().getId(), "nombre", mascota.getDueno().getNombre()) : null);
        response.put("historial", historialList);

        return ResponseEntity.ok(response);
    }

    @PostMapping("/mascotas/{id}/historial")
    public ResponseEntity<?> guardarHistorial(@PathVariable Long id, @RequestBody Map<String, String> request,
                                              @AuthenticationPrincipal Usuario usuario) {
        historialMedicoService.crearHistorial(id, usuario, request.get("tipo"), request.get("descripcion"), 
            LocalDate.parse(request.get("fecha")));
        return ResponseEntity.ok(Map.of("success", true));
    }
}
