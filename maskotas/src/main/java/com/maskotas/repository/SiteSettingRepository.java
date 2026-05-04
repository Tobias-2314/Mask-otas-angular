package com.maskotas.repository;

import com.maskotas.model.SiteSetting;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.Optional;

public interface SiteSettingRepository extends JpaRepository<SiteSetting, java.util.UUID> {
    Optional<SiteSetting> findByKey(String key);
}
