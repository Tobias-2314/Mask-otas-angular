package com.maskotas.controller;

import com.maskotas.model.Order;
import com.maskotas.model.OrderItem;
import com.maskotas.model.Producto;
import com.maskotas.model.Usuario;
import com.maskotas.service.OrdenService;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.web.bind.annotation.*;
import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/checkout")
@CrossOrigin(origins = "*")
public class CheckoutController {

    @Autowired
    private OrdenService ordenService;

    @PostMapping
    public ResponseEntity<?> store(@AuthenticationPrincipal Usuario usuario,
                                   @RequestBody Map<String, Object> body,
                                   HttpSession session) {
        List<CartItem> cart = (List<CartItem>) session.getAttribute("cart");
        if (cart == null || cart.isEmpty()) {
            return ResponseEntity.badRequest().body(Map.of("error", "El carrito está vacío"));
        }

        BigDecimal total = cart.stream()
            .map(item -> item.getPrice().multiply(BigDecimal.valueOf(item.getQuantity())))
            .reduce(BigDecimal.ZERO, BigDecimal::add);

        Order order = new Order();
        order.setUsuario(usuario);
        order.setTotal(total.doubleValue());
        order.setFecha(java.time.LocalDateTime.now());

        List<OrderItem> items = new ArrayList<>();
        for (CartItem item : cart) {
            OrderItem oi = new OrderItem();
            Producto p = new Producto();
            p.setId(Long.valueOf(item.getId()));
            p.setNombre(item.getName());
            p.setPrecio(item.getPrice().doubleValue());
            oi.setProducto(p);
            oi.setCantidad(item.getQuantity());
            oi.setSubtotal(item.getPrice().multiply(BigDecimal.valueOf(item.getQuantity())).doubleValue());
            oi.setOrder(order);
            items.add(oi);
        }
        order.setItems(items);

        ordenService.save(order);

        session.removeAttribute("cart");
        return ResponseEntity.ok(Map.of("success", true, "orderId", order.getId()));
    }
}

class CartItem {
    private String id;
    private String name;
    private Integer quantity;
    private BigDecimal price;
    private String image;

    public String getId() { return id; }
    public void setId(String id) { this.id = id; }
    public String getName() { return name; }
    public void setName(String name) { this.name = name; }
    public Integer getQuantity() { return quantity; }
    public void setQuantity(Integer quantity) { this.quantity = quantity; }
    public BigDecimal getPrice() { return price; }
    public void setPrice(BigDecimal price) { this.price = price; }
    public String getImage() { return image; }
    public void setImage(String image) { this.image = image; }
}
