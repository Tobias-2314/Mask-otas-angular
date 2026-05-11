package com.maskotas.controller;

import com.maskotas.model.Producto;
import com.maskotas.service.ProductoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.math.BigDecimal;
import java.util.Map;


@RestController
@RequestMapping("/api")
@CrossOrigin(origins = "*")
public class ProductoController {

    @Autowired
    private ProductoService productoService;

    @GetMapping("/tienda")
    public ResponseEntity<?> tienda(@RequestParam(required = false) BigDecimal minPrice,
                                    @RequestParam(required = false) BigDecimal maxPrice) {
        return ResponseEntity.ok(productoService.findByPriceRange(minPrice, maxPrice).stream().map(p -> Map.of(
            "id", p.getId(),
            "name", p.getNombre(),
            "description", p.getDescripcion(),
            "price", p.getPrecio(),
            "image", p.getImagen(),
            "stock", p.getStock()
        )).toList());
    }

    @GetMapping("/productos/stock")
    public ResponseEntity<?> stock() {
        return ResponseEntity.ok(productoService.findStockInfo().stream().map(p -> Map.of(
            "id", p.getId(), "stock", p.getStock()
        )).toList());
    }

    @GetMapping("/productos/{id}")
    public ResponseEntity<?> show(@PathVariable Long id) {
        Producto producto = productoService.findById(id).orElse(null);
        if (producto == null) return ResponseEntity.notFound().build();
        return ResponseEntity.ok(Map.of(
            "id", producto.getId(), "name", producto.getNombre(), "description", producto.getDescripcion(),
            "price", producto.getPrecio(), "image", producto.getImagen(), "stock", producto.getStock()
        ));
    }
}
