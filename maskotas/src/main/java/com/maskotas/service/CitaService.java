package com.maskotas.service;

import com.maskotas.model.Cita;
import com.maskotas.model.EstadoCita;
import com.maskotas.model.Mascota;
import com.maskotas.model.Usuario;
import com.maskotas.repository.CitaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.time.LocalDate;
import java.time.LocalTime;
import java.util.Arrays;
import java.util.List;
import java.util.Optional;


@Service
public class CitaService {

    @Autowired
    private CitaRepository citaRepository;

    public List<Cita> findOcupadas() {
        return citaRepository.findByFechaPreferidaAfterAndEstadoIn(
            LocalDate.now().minusDays(1),
            Arrays.asList(EstadoCita.PENDIENTE, EstadoCita.CONFIRMADA)
        );
    }

    public boolean existeCita(LocalDate fecha, LocalTime hora) {
        return citaRepository.findByFechaPreferidaAndHoraPreferidaAndEstadoIn(
            fecha, hora, Arrays.asList("pendiente", "confirmada")
        ).size() > 0;
    }

    public Cita save(Cita cita) {
        return citaRepository.save(cita);
    }

    public Optional<Cita> findById(Long id) {
        return citaRepository.findById(id);
    }

    public List<Cita> findByUsuarioIdOrderByFechaDesc(Long usuarioId) {
        return citaRepository.findByUsuarioIdOrderByFechaPreferidaDesc(usuarioId);
    }

    public List<Cita> findByEstadoInOrderByFechaAsc(List<EstadoCita> estados) {
        return citaRepository.findByEstadoInOrderByFechaPreferidaAsc(estados);
    }

    public void deleteById(Long id) {
        citaRepository.deleteById(id);
    }

    public Cita crearCita(Usuario usuario, Mascota mascota, String nombreDueno, String email,
                          String telefono, String nombreMascota, String tipoMascota,
                          String tipoServicio, LocalDate fecha, LocalTime hora, String notas) {
        Cita cita = new Cita();
        cita.setUsuario(usuario);
        cita.setNombreDueno(nombreDueno);
        cita.setEmail(email);
        cita.setTelefono(telefono);
        cita.setTipoServicio(tipoServicio);
        cita.setFechaPreferida(fecha);
        cita.setHoraPreferida(hora);
        cita.setNotas(notas);

        if (mascota != null) {
            cita.setMascota(mascota);
            cita.setNombreMascota(mascota.getNombre());
            cita.setTipoMascota(mascota.getTipo());
        } else {
            cita.setNombreMascota(nombreMascota);
            cita.setTipoMascota(tipoMascota);
        }

        return citaRepository.save(cita);
    }
}
