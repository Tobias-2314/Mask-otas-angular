package com.maskotas.service;

import com.maskotas.model.Resena;
import com.maskotas.model.Usuario;
import com.maskotas.repository.ResenaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.List;
import java.util.Optional;


@Service
public class ResenaService {

    @Autowired
    private ResenaRepository resenaRepository;

    public List<Resena> findAll() {
        return resenaRepository.findAll();
    }

    public Optional<Resena> findById(Long id) {
        return resenaRepository.findById(id);
    }

    public Resena save(Resena resena) {
        return resenaRepository.save(resena);
    }

    public Resena crearResena(Usuario usuario, Integer calificacion, String comentario) {
        Resena resena = new Resena();
        resena.setUsuario(usuario);
        resena.setValoracion(calificacion);
        resena.setComentario(comentario);
        return resenaRepository.save(resena);
    }

    public void deleteById(Long id) {
        resenaRepository.deleteById(id);
    }
}
