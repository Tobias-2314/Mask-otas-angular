package com.maskotas.service;

import com.maskotas.model.Mascota;
import com.maskotas.model.Usuario;
import com.maskotas.repository.MascotaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.List;
import java.util.Optional;

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
        if (search == null || search.isBlank()) {
            return mascotaRepository.findAll();
        }
        return mascotaRepository.search(search);
    }
}
