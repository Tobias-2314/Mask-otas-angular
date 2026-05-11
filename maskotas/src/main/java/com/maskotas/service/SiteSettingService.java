package com.maskotas.service;

import com.maskotas.model.SiteSetting;
import com.maskotas.repository.SiteSettingRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.Optional;

@Service
public class SiteSettingService {

    @Autowired
    private SiteSettingRepository siteSettingRepository;

    public Optional<SiteSetting> findByKey(String key) {
        return siteSettingRepository.findByClave(key);
    }

    public SiteSetting save(SiteSetting setting) {
        return siteSettingRepository.save(setting);
    }
}
