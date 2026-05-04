package com.maskotas.service;

import com.maskotas.model.Producto;
import com.maskotas.repository.ProductoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.math.BigDecimal;
import java.util.stream.Collectors;
import java.util.List;
import java.util.Optional;

import java.util.stream.Collectors;

@Service
public class ProductoService {

    @Autowired
    private ProductoRepository productoRepository;

    public List<Producto> findAll() {
        return productoRepository.findAll();
    }

    public List<Producto> findByPriceRange(BigDecimal min, BigDecimal max) {
        List<Producto> all = productoRepository.findAll();
        if (min != null && max != null) {
            return all.stream()
                .filter(p -> BigDecimal.valueOf(p.getPrecio()).compareTo(min) >= 0 && BigDecimal.valueOf(p.getPrecio()).compareTo(max) <= 0)
                .collect(Collectors.toList());
        } else if (min != null) {
            return all.stream()
                .filter(p -> BigDecimal.valueOf(p.getPrecio()).compareTo(min) >= 0)
                .collect(Collectors.toList());
        } else if (max != null) {
            return all.stream()
                .filter(p -> BigDecimal.valueOf(p.getPrecio()).compareTo(max) <= 0)
                .collect(Collectors.toList());
        }
        return all;
    }

    public List<Producto> findStockInfo() {
        return productoRepository.findAll();
    }

    public Optional<Producto> findById(Long id) {
        return productoRepository.findById(id);
    }

    public Producto save(Producto producto) {
        return productoRepository.save(producto);
    }

    public void deleteById(Long id) {
        productoRepository.deleteById(id);
    }
}
