<template>
  <!-- Saltar al contenido principal (accesibilidad de teclado) -->
  <a href="#main-content" class="skip-link">Saltar al contenido principal</a>

  <div class="app-wrapper">
    <!-- El <header> envuelve la navegación principal (HTML semántico) -->
    <header>
      <NavBar />
    </header>

    <main id="main-content">
      <RouterView />
    </main>

    <ChatWidget />

    <!-- Controles de accesibilidad flotantes -->
    <div class="a11y-controls" role="group" aria-label="Controles de accesibilidad">
      <button
        class="a11y-btn"
        @click="toggleDark"
        :aria-label="isDark ? 'Activar modo claro' : 'Activar modo oscuro'"
        :title="isDark ? 'Modo claro' : 'Modo oscuro'"
      >
        <svg v-if="isDark" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        <svg v-else width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
      </button>
      <button class="a11y-btn" @click="increaseFontSize" aria-label="Aumentar tamaño de letra" title="Aumentar letra">A+</button>
      <button class="a11y-btn" @click="decreaseFontSize" aria-label="Reducir tamaño de letra" title="Reducir letra">A-</button>
    </div>

    <footer class="footer">
      <div class="container">
        <div class="footer-top">
          <div class="footer-brand-col">
            <div class="footer-logo">MASKOTAS</div>
            <p class="footer-tagline">Cuidamos a quienes más amas con experiencia médica y amor incondicional.</p>
            <div class="footer-social">
              <!-- rel="noopener noreferrer" requerido en enlaces externos con target="_blank" -->
              <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="social-dot" aria-label="Instagram (abre en nueva pestaña)">ig</a>
              <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="social-dot" aria-label="Facebook (abre en nueva pestaña)">fb</a>
              <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="social-dot" aria-label="Twitter (abre en nueva pestaña)">tw</a>
            </div>
          </div>

          <nav class="footer-nav" aria-label="Navegación del pie de página">
            <div class="footer-col">
              <h5 class="footer-col-title">Clínica</h5>
              <ul>
                <li><RouterLink to="/servicios">Servicios</RouterLink></li>
                <li><RouterLink to="/tienda">Tienda</RouterLink></li>
                <li><RouterLink to="/resenas">Reseñas</RouterLink></li>
                <li><RouterLink to="/citas">Agendar Cita</RouterLink></li>
              </ul>
            </div>
            <div class="footer-col">
              <h5 class="footer-col-title">Soporte</h5>
              <ul>
                <li><RouterLink to="/contacto">Contacto</RouterLink></li>
                <li><RouterLink to="/mi-cuenta">Mi Cuenta</RouterLink></li>
              </ul>
            </div>
            <div class="footer-col">
              <h5 class="footer-col-title">Legal</h5>
              <ul>
                <li><RouterLink to="/politica-privacidad">Privacidad</RouterLink></li>
                <li><RouterLink to="/politica-cookies">Cookies</RouterLink></li>
                <li><RouterLink to="/terminos-servicio">Términos</RouterLink></li>
                <li><RouterLink to="/sostenibilidad">Sostenibilidad</RouterLink></li>
              </ul>
            </div>
          </nav>

          <div class="footer-contact-col">
            <h5 class="footer-col-title">Visítanos</h5>
            <address>
              <p>Calle Veterinaria 123</p>
              <p>Madrid, España</p>
              <p class="footer-contact-link"><a href="tel:+34912345678">+34 912 345 678</a></p>
              <p class="footer-contact-link"><a href="mailto:info@maskotas.com">info@maskotas.com</a></p>
            </address>
          </div>
        </div>

        <div class="footer-bottom">
          <span>&copy; {{ year }} Maskotas — Clínica Veterinaria</span>
          <span class="footer-dot">·</span>
          <span>Todos los derechos reservados</span>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import NavBar from './components/NavBar.vue'
import ChatWidget from './components/ChatWidget.vue'

const year = new Date().getFullYear()
const isDark = ref(false)
const fontScale = ref(1)

function toggleDark() {
  isDark.value = !isDark.value
  document.documentElement.setAttribute('data-theme', isDark.value ? 'dark' : 'light')
  localStorage.setItem('maskotas-theme', isDark.value ? 'dark' : 'light')
}

function increaseFontSize() {
  if (fontScale.value < 1.4) {
    fontScale.value = Math.round((fontScale.value + 0.1) * 10) / 10
    applyFontScale()
  }
}

function decreaseFontSize() {
  if (fontScale.value > 0.8) {
    fontScale.value = Math.round((fontScale.value - 0.1) * 10) / 10
    applyFontScale()
  }
}

function applyFontScale() {
  document.documentElement.style.setProperty('--font-scale', fontScale.value)
  localStorage.setItem('maskotas-font-scale', fontScale.value)
}

onMounted(() => {
  /* Restaurar preferencias guardadas */
  const savedTheme = localStorage.getItem('maskotas-theme')
  if (savedTheme === 'dark') {
    isDark.value = true
    document.documentElement.setAttribute('data-theme', 'dark')
  }
  const savedScale = parseFloat(localStorage.getItem('maskotas-font-scale') || '1')
  fontScale.value = savedScale
  document.documentElement.style.setProperty('--font-scale', savedScale)
})
</script>

<style scoped>
.app-wrapper { display: flex; flex-direction: column; min-height: 100vh; }
main { flex: 1; padding-bottom: 2.5rem; }

.footer {
  background: var(--deep);
  color: rgba(250,246,238,.75);
  padding: 4rem 0 0;
  margin-top: auto;
}

.footer-top {
  display: grid;
  grid-template-columns: 1.6fr 2fr 1fr;
  gap: 3rem;
  padding-bottom: 3rem;
  border-bottom: 1px solid rgba(255,255,255,.08);
}
@media (max-width: 900px) {
  .footer-top { grid-template-columns: 1fr 1fr; gap: 2rem; }
  .footer-brand-col { grid-column: 1 / -1; }
}
@media (max-width: 520px) {
  .footer-top { grid-template-columns: 1fr; }
}

.footer-logo {
  font-family: 'Fraunces', serif;
  font-size: 2rem;
  font-weight: 600;
  color: var(--cream);
  letter-spacing: 0.08em;
  margin-bottom: 0.75rem;
}

.footer-tagline {
  font-size: 0.88rem;
  line-height: 1.7;
  color: rgba(250,246,238,.55);
  max-width: 280px;
  margin-bottom: 1.5rem;
}

.footer-social { display: flex; gap: 0.6rem; }
.social-dot {
  width: 34px; height: 34px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,.2);
  display: flex; align-items: center; justify-content: center;
  font-size: 0.65rem; font-weight: 700; text-transform: uppercase;
  color: rgba(250,246,238,.6);
  transition: all 0.2s;
}
.social-dot:hover {
  border-color: var(--gold);
  color: var(--gold);
  transform: translateY(-2px);
}
.social-dot:focus-visible {
  outline: 2px solid var(--gold);
  outline-offset: 2px;
}

.footer-nav { display: flex; gap: 3rem; }
@media (max-width: 600px) { .footer-nav { gap: 1.5rem; flex-wrap: wrap; } }

.footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.55rem; }
.footer-col a {
  font-size: 0.85rem;
  color: rgba(250,246,238,.55);
  transition: color 0.18s;
}
.footer-col a:hover { color: var(--gold); }
.footer-col a:focus-visible { outline: 2px solid var(--gold); outline-offset: 2px; border-radius: 2px; }

.footer-col-title {
  font-family: 'Jost', sans-serif;
  font-size: 0.7rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: rgba(253,249,243,.35);
  margin-bottom: 1rem;
}

.footer-contact-col address { font-style: normal; }
.footer-contact-col p {
  font-size: 0.85rem;
  color: rgba(250,246,238,.55);
  line-height: 1.9;
}
.footer-contact-link a {
  color: rgba(250,246,238,.7);
  transition: color 0.18s;
}
.footer-contact-link a:hover { color: var(--gold); }

.footer-bottom {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  justify-content: center;
  padding: 1.25rem 0;
  font-size: 0.78rem;
  color: rgba(250,246,238,.25);
}
.footer-dot { opacity: 0.4; }
</style>
