package com.maskotas.repository;

import com.maskotas.model.Mascota;
import com.maskotas.model.Usuario;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import java.util.List;

public interface MascotaRepository extends JpaRepository<Mascota, Long> {
    List<Mascota> findByDuenoId(Long usuarioId);
    List<Mascota> findByDueno(Usuario dueno);

    @Query("SELECT m FROM Mascota m LEFT JOIN m.dueno d WHERE " +
           "LOWER(m.nombre) LIKE LOWER(CONCAT('%', :q, '%')) OR " +
           "LOWER(d.nombre) LIKE LOWER(CONCAT('%', :q, '%')) OR " +
           "LOWER(d.email) LIKE LOWER(CONCAT('%', :q, '%'))")
    List<Mascota> search(@Param("q") String q);
}
