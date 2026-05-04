package com.maskotas.model;

import jakarta.persistence.*;
import lombok.Data;

@Entity
@Table(name = "site_settings")
@Data
public class SiteSetting {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String clave;
    private String valor;
}
