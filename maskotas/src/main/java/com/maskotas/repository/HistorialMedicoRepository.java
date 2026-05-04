package com.maskotas.repository;

import com.maskotas.model.HistorialMedico;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.List;
public interface HistorialMedicoRepository extends JpaRepository<HistorialMedico, Long> {
    List<HistorialMedico> findByMascotaIdOrderByFechaDesc(Long mascotaId);
}
