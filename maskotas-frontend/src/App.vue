<template>
  <div class="app-wrapper">
    <NavBar />
    <main>
      <RouterView />
    </main>
    <ChatWidget />

    <footer class="footer">
      <div class="container footer-grid">
        <div>
          <h3 class="footer-brand">🐾 MASK!OTAS</h3>
          <p class="footer-text">Cuidamos a quienes más amas con tecnología de punta y amor incondicional.</p>
        </div>
        <div>
          <h4 class="footer-heading">Navegación</h4>
          <ul class="footer-links">
            <li><RouterLink to="/servicios">Servicios</RouterLink></li>
            <li><RouterLink to="/tienda">Tienda</RouterLink></li>
            <li><RouterLink to="/resenas">Reseñas</RouterLink></li>
            <li><RouterLink to="/contacto">Contacto</RouterLink></li>
          </ul>
        </div>
        <div>
          <h4 class="footer-heading">Legal</h4>
          <ul class="footer-links">
            <li><RouterLink to="/politica-privacidad">Política de Privacidad</RouterLink></li>
            <li><RouterLink to="/politica-cookies">Política de Cookies</RouterLink></li>
            <li><RouterLink to="/terminos-servicio">Términos de Servicio</RouterLink></li>
          </ul>
        </div>
        <div>
          <h4 class="footer-heading">Contacto</h4>
          <p class="footer-text">Calle Veterinaria 123, Madrid</p>
          <p class="footer-text">info@maskotas.com</p>
        </div>
      </div>
      <div class="footer-copy">
        &copy; {{ year }} MASK!OTAS. Todos los derechos reservados.
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
main { flex: 1; padding-bottom: 2rem; }

.footer {
  background: #111827; color: #fff;
  padding: 3rem 0 0;
  margin-top: auto;
}
.footer-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 2rem;
  padding-bottom: 2rem;
}
.footer-brand { font-size: 1.3rem; font-weight: 800; margin-bottom: .5rem; }
.footer-heading { font-size: .9rem; font-weight: 700; margin-bottom: .75rem; color: #d1d5db; }
.footer-text { font-size: .85rem; color: #9ca3af; line-height: 1.6; }
.footer-links { list-style: none; display: flex; flex-direction: column; gap: .5rem; }
.footer-links a { font-size: .85rem; color: #9ca3af; text-decoration: none; transition: color .15s; }
.footer-links a:hover { color: #818cf8; }
.footer-copy {
  text-align: center; font-size: .8rem; color: #4b5563;
  border-top: 1px solid #1f2937; padding: 1.25rem 0;
}
</style>
