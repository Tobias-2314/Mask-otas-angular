package com.maskotas.service;

import com.maskotas.model.HistorialMedico;
import com.maskotas.model.Mascota;
import com.maskotas.model.Usuario;
import com.maskotas.repository.HistorialMedicoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.time.LocalDate;
import java.util.List;
import java.util.Optional;


@Service
public class HistorialMedicoService {

    @Autowired
    private HistorialMedicoRepository historialMedicoRepository;

    public List<HistorialMedico> findByMascotaId(Long mascotaId) {
        return historialMedicoRepository.findByMascotaIdOrderByFechaDesc(mascotaId);
    }

    public HistorialMedico save(HistorialMedico historial) {
        return historialMedicoRepository.save(historial);
    }

    public HistorialMedico crearHistorial(Long mascotaId, Usuario usuario, String tipo, String descripcion, LocalDate fecha) {
        HistorialMedico historial = new HistorialMedico();
        Mascota mascota = new Mascota();
        mascota.setId(mascotaId);
        historial.setMascota(mascota);
        historial.setVeterinario(usuario);
        historial.setTipo(tipo);
        historial.setDescripcion(descripcion);
        historial.setFecha(fecha);
        return historialMedicoRepository.save(historial);
    }
}
