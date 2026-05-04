package com.maskotas.repository;

import com.maskotas.model.Cita;
import com.maskotas.model.EstadoCita;
import org.springframework.data.jpa.repository.JpaRepository;
import java.time.LocalDate;
import java.util.List;
public interface CitaRepository extends JpaRepository<Cita, Long> {
    List<Cita> findByFechaPreferidaAfterAndEstadoIn(LocalDate date, List<EstadoCita> estados);
    List<Cita> findByFechaPreferidaAndHoraPreferidaAndEstadoIn(LocalDate fecha, java.time.LocalTime hora, List<EstadoCita> estados);
    List<Cita> findByUsuarioIdOrderByFechaPreferidaDesc(Long usuarioId);
    List<Cita> findByEstadoInOrderByFechaPreferidaAsc(List<EstadoCita> estados);
}
