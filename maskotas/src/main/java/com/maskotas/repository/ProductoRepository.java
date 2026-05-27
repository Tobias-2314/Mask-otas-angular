package com.maskotas.repository;

import com.maskotas.model.Producto;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.List;

public interface ProductoRepository extends JpaRepository<Producto, Long> {
    List<Producto> findByPrecioBetween(Double min, Double max);
    List<Producto> findByPrecioGreaterThanEqual(Double min);
    List<Producto> findByPrecioLessThanEqual(Double max);
}
