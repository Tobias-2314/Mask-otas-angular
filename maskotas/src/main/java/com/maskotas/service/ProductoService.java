package com.maskotas.service;

import com.maskotas.model.Producto;
import com.maskotas.repository.ProductoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.math.BigDecimal;
import java.util.List;
import java.util.Optional;

@Service
public class ProductoService {

    @Autowired
    private ProductoRepository productoRepository;

    public List<Producto> findAll() {
        return productoRepository.findAll();
    }

    public List<Producto> findByPriceRange(BigDecimal min, BigDecimal max) {
        if (min != null && max != null) {
            return productoRepository.findByPrecioBetween(min.doubleValue(), max.doubleValue());
        } else if (min != null) {
            return productoRepository.findByPrecioGreaterThanEqual(min.doubleValue());
        } else if (max != null) {
            return productoRepository.findByPrecioLessThanEqual(max.doubleValue());
        }
        return productoRepository.findAll();
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
