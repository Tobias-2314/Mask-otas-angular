package com.maskotas.service;

import com.maskotas.model.Order;
import com.maskotas.repository.OrderRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.time.LocalDateTime;
import java.util.List;
import java.util.Optional;

@Service
public class OrdenService {

    @Autowired
    private OrderRepository orderRepository;

    public List<Order> findByUserId(Long userId) {
        return orderRepository.findByUsuarioIdOrderByFechaDesc(userId);
    }

    public Optional<Order> findById(Long id) {
        return orderRepository.findById(id);
    }

    public Order save(Order order) {
        return orderRepository.save(order);
    }

    public List<Order> findCompletedSince(LocalDateTime since) {
        return orderRepository.findByFechaAfterOrderByFechaDesc(since);
    }
}
