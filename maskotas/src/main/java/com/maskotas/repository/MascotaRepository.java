package com.maskotas.repository;

import com.maskotas.model.Mascota;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.List;
public interface MascotaRepository extends JpaRepository<Mascota, Long> {
    List<Mascota> findByDuenoId(Long usuarioId);
    List<Mascota> findByDueno(com.maskotas.model.Usuario dueno);
}
