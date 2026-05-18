<template>
  <div class="app-wrapper">
    <NavBar />
    <main>
      <RouterView />
    </main>
    <ChatWidget />

    <footer class="footer">
      <div class="container">
        <div class="footer-top">
          <div class="footer-brand-col">
            <div class="footer-logo">MASKOTAS</div>
            <p class="footer-tagline">Cuidamos a quienes más amas con experiencia médica y amor incondicional.</p>
            <div class="footer-social">
              <a href="#" class="social-dot" aria-label="Instagram">ig</a>
              <a href="#" class="social-dot" aria-label="Facebook">fb</a>
              <a href="#" class="social-dot" aria-label="Twitter">tw</a>
            </div>
          </div>

          <nav class="footer-nav">
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
import NavBar from './components/NavBar.vue'
import ChatWidget from './components/ChatWidget.vue'

const year = new Date().getFullYear()
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

.footer-nav { display: flex; gap: 3rem; }
@media (max-width: 600px) { .footer-nav { gap: 1.5rem; flex-wrap: wrap; } }

.footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.55rem; }
.footer-col a {
  font-size: 0.85rem;
  color: rgba(250,246,238,.55);
  transition: color 0.18s;
}
.footer-col a:hover { color: var(--gold); }

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
