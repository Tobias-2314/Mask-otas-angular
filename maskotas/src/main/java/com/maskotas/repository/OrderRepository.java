package com.maskotas.repository;

import com.maskotas.model.Order;
import org.springframework.data.jpa.repository.JpaRepository;
import java.time.LocalDateTime;
import java.util.List;

public interface OrderRepository extends JpaRepository<Order, Long> {
    List<Order> findByUsuarioIdOrderByFechaDesc(Long userId);
    List<Order> findByFechaAfterOrderByFechaDesc(LocalDateTime since);
}
