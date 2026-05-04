package com.maskotas.service;

import com.maskotas.model.Mascota;
import com.maskotas.model.Usuario;
import com.maskotas.repository.MascotaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.List;
import java.util.Optional;

import java.util.stream.Collectors;

@Service
public class MascotaService {

    @Autowired
    private MascotaRepository mascotaRepository;

    public List<Mascota> findByUsuarioId(Long usuarioId) {
        return mascotaRepository.findByDuenoId(usuarioId);
    }

    public List<Mascota> findByUsuario(Usuario usuario) {
        return mascotaRepository.findByDueno(usuario);
    }

    public List<Mascota> findAll() {
        return mascotaRepository.findAll();
    }

    public Optional<Mascota> findById(Long id) {
        return mascotaRepository.findById(id);
    }

    public Mascota save(Mascota mascota) {
        return mascotaRepository.save(mascota);
    }

    public void deleteById(Long id) {
        mascotaRepository.deleteById(id);
    }

    public List<Mascota> search(String search) {
        if (search == null || search.isEmpty()) {
            return mascotaRepository.findAll();
        }
        String lowerSearch = search.toLowerCase();
        return mascotaRepository.findAll().stream()
            .filter(m -> m.getNombre().toLowerCase().contains(lowerSearch)
                || (m.getDueno() != null && m.getDueno().getNombre().toLowerCase().contains(lowerSearch))
                || (m.getDueno() != null && m.getDueno().getEmail().toLowerCase().contains(lowerSearch)))
            .collect(Collectors.toList());
    }
}
