/**
 * Sistema de Gestión de Cookies - MASK!OTAS
 * Conforme al RGPD (Reglamento UE 2016/679)
 */

class CookieManager {
    constructor() {
        this.cookieName = 'maskotas_cookie_consent';
        this.cookieExpireDays = 365;
        this.init();
    }

    init() {
        // Verificar si ya existe consentimiento
        const consent = this.getConsent();
        
        if (!consent) {
            // Mostrar banner si no hay consentimiento
            this.showBanner();
        } else {
            // Aplicar preferencias guardadas
            this.applyConsent(consent);
        }

        // Event listeners
        this.attachEventListeners();
    }

    attachEventListeners() {
        // Botón Aceptar Todo
        const acceptAllBtn = document.getElementById('accept-all-cookies');
        if (acceptAllBtn) {
            acceptAllBtn.addEventListener('click', () => this.acceptAll());
        }

        // Botón Rechazar Todo
        const rejectAllBtn = document.getElementById('reject-all-cookies');
        if (rejectAllBtn) {
            rejectAllBtn.addEventListener('click', () => this.rejectAll());
        }

        // Botón Configurar
        const configureBtn = document.getElementById('configure-cookies');
        if (configureBtn) {
            configureBtn.addEventListener('click', () => this.showModal());
        }

        // Botón Guardar Preferencias
        const savePreferencesBtn = document.getElementById('save-cookie-preferences');
        if (savePreferencesBtn) {
            savePreferencesBtn.addEventListener('click', () => this.savePreferences());
        }

        // Botón Cerrar Modal
        const closeModalBtn = document.getElementById('close-cookie-modal');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => this.hideModal());
        }

        // Cerrar modal al hacer clic fuera
        const modal = document.getElementById('cookie-modal');
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    this.hideModal();
                }
            });
        }
    }

    showBanner() {
        const banner = document.getElementById('cookie-banner');
        if (banner) {
            banner.classList.remove('hidden');
            // Animación de entrada
            setTimeout(() => {
                banner.classList.add('opacity-100');
                banner.classList.remove('opacity-0');
            }, 100);
        }
    }

    hideBanner() {
        const banner = document.getElementById('cookie-banner');
        if (banner) {
            banner.classList.add('opacity-0');
            banner.classList.remove('opacity-100');
            setTimeout(() => {
                banner.classList.add('hidden');
            }, 300);
        }
    }

    showModal() {
        const modal = document.getElementById('cookie-modal');
        if (modal) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modal.classList.remove('opacity-0');
            }, 10);
        }
    }

    hideModal() {
        const modal = document.getElementById('cookie-modal');
        if (modal) {
            modal.classList.add('opacity-0');
            modal.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }

    acceptAll() {
        const consent = {
            necessary: true,
            functional: true,
            analytics: true,
            marketing: true,
            timestamp: new Date().toISOString()
        };
        this.saveConsent(consent);
        this.applyConsent(consent);
        this.hideBanner();
        this.hideModal();
    }

    rejectAll() {
        const consent = {
            necessary: true, // Las cookies necesarias siempre están activas
            functional: false,
            analytics: false,
            marketing: false,
            timestamp: new Date().toISOString()
        };
        this.saveConsent(consent);
        this.applyConsent(consent);
        this.hideBanner();
        this.hideModal();
    }

    savePreferences() {
        const consent = {
            necessary: true, // Siempre true
            functional: document.getElementById('cookie-functional')?.checked || false,
            analytics: document.getElementById('cookie-analytics')?.checked || false,
            marketing: document.getElementById('cookie-marketing')?.checked || false,
            timestamp: new Date().toISOString()
        };
        this.saveConsent(consent);
        this.applyConsent(consent);
        this.hideBanner();
        this.hideModal();
    }

    saveConsent(consent) {
        const consentString = JSON.stringify(consent);
        const expiryDate = new Date();
        expiryDate.setDate(expiryDate.getDate() + this.cookieExpireDays);
        
        document.cookie = `${this.cookieName}=${encodeURIComponent(consentString)}; expires=${expiryDate.toUTCString()}; path=/; SameSite=Strict`;
        
        console.log('Consentimiento de cookies guardado:', consent);
    }

    getConsent() {
        const name = this.cookieName + '=';
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookieArray = decodedCookie.split(';');
        
        for (let i = 0; i < cookieArray.length; i++) {
            let cookie = cookieArray[i].trim();
            if (cookie.indexOf(name) === 0) {
                try {
                    return JSON.parse(cookie.substring(name.length));
                } catch (e) {
                    console.error('Error al parsear consentimiento de cookies:', e);
                    return null;
                }
            }
        }
        return null;
    }

    applyConsent(consent) {
        console.log('Aplicando consentimiento de cookies:', consent);

        // Cookies funcionales
        if (consent.functional) {
            this.enableFunctionalCookies();
        } else {
            this.disableFunctionalCookies();
        }

        // Cookies de análisis
        if (consent.analytics) {
            this.enableAnalyticsCookies();
        } else {
            this.disableAnalyticsCookies();
        }

        // Cookies de marketing
        if (consent.marketing) {
            this.enableMarketingCookies();
        } else {
            this.disableMarketingCookies();
        }
    }

    enableFunctionalCookies() {
        console.log('Cookies funcionales habilitadas');
        // Aquí se habilitarían cookies funcionales específicas
        // Ejemplo: preferencias de idioma, tema oscuro, etc.
    }

    disableFunctionalCookies() {
        console.log('Cookies funcionales deshabilitadas');
        // Eliminar cookies funcionales si existen
    }

    enableAnalyticsCookies() {
        console.log('Cookies de análisis habilitadas');
        
        // Google Analytics (ejemplo)
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'analytics_storage': 'granted'
            });
        }

        // Aquí se cargaría Google Analytics u otras herramientas de análisis
        // window.dataLayer = window.dataLayer || [];
        // function gtag(){dataLayer.push(arguments);}
        // gtag('js', new Date());
        // gtag('config', 'GA_MEASUREMENT_ID');
    }

    disableAnalyticsCookies() {
        console.log('Cookies de análisis deshabilitadas');
        
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'analytics_storage': 'denied'
            });
        }
    }

    enableMarketingCookies() {
        console.log('Cookies de marketing habilitadas');
        
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'ad_storage': 'granted',
                'ad_user_data': 'granted',
                'ad_personalization': 'granted'
            });
        }
    }

    disableMarketingCookies() {
        console.log('Cookies de marketing deshabilitadas');
        
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'ad_storage': 'denied',
                'ad_user_data': 'denied',
                'ad_personalization': 'denied'
            });
        }
    }

    // Método público para reabrir configuración
    openSettings() {
        const consent = this.getConsent();
        if (consent) {
            // Pre-cargar preferencias actuales en el modal
            if (document.getElementById('cookie-functional')) {
                document.getElementById('cookie-functional').checked = consent.functional;
            }
            if (document.getElementById('cookie-analytics')) {
                document.getElementById('cookie-analytics').checked = consent.analytics;
            }
            if (document.getElementById('cookie-marketing')) {
                document.getElementById('cookie-marketing').checked = consent.marketing;
            }
        }
        this.showModal();
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.cookieManager = new CookieManager();
});
