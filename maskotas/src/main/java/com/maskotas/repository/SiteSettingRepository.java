package com.maskotas.repository;

import com.maskotas.model.SiteSetting;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.Optional;

public interface SiteSettingRepository extends JpaRepository<SiteSetting, Long> {
    Optional<SiteSetting> findByClave(String clave);
}
