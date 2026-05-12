package com.maskotas.controller;

import com.maskotas.model.CartItem;
import com.maskotas.model.Producto;
import com.maskotas.service.ProductoService;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/carrito")
public class CartController {

    @Autowired
    private ProductoService productoService;

    private String getCartKey() { return "cart"; }

    @GetMapping
    public ResponseEntity<?> showCart(HttpSession session) {
        List<CartItem> cart = (List<CartItem>) session.getAttribute(getCartKey());
        if (cart == null) cart = new ArrayList<>();

        BigDecimal total = cart.stream()
            .map(item -> item.getPrice().multiply(BigDecimal.valueOf(item.getQuantity())))
            .reduce(BigDecimal.ZERO, BigDecimal::add);

        return ResponseEntity.ok(Map.of("cart", cart, "total", total, "count", cart.size()));
    }

    @PostMapping("/agregar/{id}")
    public ResponseEntity<?> addToCart(@PathVariable Long id, HttpSession session) {
        Producto producto = productoService.findById(id).orElse(null);
        if (producto == null) return ResponseEntity.notFound().build();
        if (producto.getStock() <= 0) {
            return ResponseEntity.status(422).body(Map.of("error", "Producto sin stock"));
        }

        List<CartItem> cart = (List<CartItem>) session.getAttribute(getCartKey());
        if (cart == null) cart = new ArrayList<>();

        CartItem existing = cart.stream().filter(i -> i.getId().equals(id.toString())).findFirst().orElse(null);
        if (existing != null) {
            if (existing.getQuantity() >= producto.getStock()) {
                return ResponseEntity.status(422).body(Map.of("error", "No hay más stock disponible"));
            }
            existing.setQuantity(existing.getQuantity() + 1);
        } else {
            CartItem item = new CartItem();
            item.setId(id.toString());
            item.setName(producto.getNombre());
            item.setQuantity(1);
            item.setPrice(BigDecimal.valueOf(producto.getPrecio()));
            item.setImage(producto.getImagen());
            cart.add(item);
        }

        session.setAttribute(getCartKey(), cart);
        return ResponseEntity.ok(Map.of("success", true, "cart_count", cart.size()));
    }

    @DeleteMapping("/eliminar/{id}")
    public ResponseEntity<?> removeFromCart(@PathVariable Long id, HttpSession session) {
        List<CartItem> cart = (List<CartItem>) session.getAttribute(getCartKey());
        if (cart != null) {
            cart.removeIf(i -> i.getId().equals(id.toString()));
            session.setAttribute(getCartKey(), cart);
        }
        return ResponseEntity.ok(Map.of("success", true));
    }

    @PatchMapping("/incrementar/{id}")
    public ResponseEntity<?> increment(@PathVariable Long id, HttpSession session) {
        List<CartItem> cart = (List<CartItem>) session.getAttribute(getCartKey());
        if (cart != null) {
            CartItem item = cart.stream().filter(i -> i.getId().equals(id.toString())).findFirst().orElse(null);
            if (item != null) {
                Producto producto = productoService.findById(id).orElse(null);
                if (producto != null && item.getQuantity() >= producto.getStock()) {
                    return ResponseEntity.status(422).body(Map.of("error", "No hay más stock"));
                }
                item.setQuantity(item.getQuantity() + 1);
                session.setAttribute(getCartKey(), cart);
            }
        }
        return ResponseEntity.ok(Map.of("success", true));
    }

    @PatchMapping("/decrementar/{id}")
    public ResponseEntity<?> decrement(@PathVariable Long id, HttpSession session) {
        List<CartItem> cart = (List<CartItem>) session.getAttribute(getCartKey());
        if (cart != null) {
            CartItem item = cart.stream().filter(i -> i.getId().equals(id.toString())).findFirst().orElse(null);
            if (item != null) {
                if (item.getQuantity() > 1) {
                    item.setQuantity(item.getQuantity() - 1);
                } else {
                    cart.remove(item);
                }
                session.setAttribute(getCartKey(), cart);
            }
        }
        return ResponseEntity.ok(Map.of("success", true));
    }
}
