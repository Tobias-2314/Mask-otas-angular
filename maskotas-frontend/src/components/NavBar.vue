<template>
  <nav class="navbar" :class="{ scrolled: isScrolled }">
    <div class="container nav-inner">
      <RouterLink to="/" class="logo">
        <span class="logo-mark">
          <svg width="14" height="14" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <ellipse cx="30" cy="36" rx="11" ry="13.5" transform="rotate(-12 30 36)"/>
            <ellipse cx="50" cy="28" rx="11" ry="13.5"/>
            <ellipse cx="70" cy="36" rx="11" ry="13.5" transform="rotate(12 70 36)"/>
            <ellipse cx="17" cy="53" rx="8" ry="10" transform="rotate(-20 17 53)"/>
            <ellipse cx="50" cy="67" rx="22" ry="17"/>
          </svg>
        </span>
        <span class="logo-text">MASKOTAS</span>
      </RouterLink>

      <div class="nav-links" :class="{ open: menuOpen }">
        <RouterLink to="/servicios" @click="menuOpen = false">Servicios</RouterLink>
        <RouterLink to="/tienda" @click="menuOpen = false">Tienda</RouterLink>
        <RouterLink to="/resenas" @click="menuOpen = false">Reseñas</RouterLink>
        <RouterLink to="/contacto" @click="menuOpen = false">Contacto</RouterLink>
        <RouterLink to="/admin/dashboard" v-if="auth.isAdmin" @click="menuOpen = false" class="admin-link">Admin</RouterLink>
        <RouterLink to="/veterinario/dashboard" v-if="auth.isVeterinario && !auth.isAdmin" @click="menuOpen = false" class="admin-link">Vet Panel</RouterLink>
      </div>

      <div class="nav-actions">
        <RouterLink v-if="auth.isAdmin" to="/admin/dashboard" class="btn btn-panel btn-sm">Admin</RouterLink>
        <RouterLink v-else-if="auth.isVeterinario" to="/veterinario/dashboard" class="btn btn-panel btn-sm">Mi Panel</RouterLink>

        <RouterLink to="/carrito" class="cart-btn" title="Carrito">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
          <span v-if="cart.count > 0" class="cart-badge">{{ cart.count }}</span>
        </RouterLink>

        <template v-if="auth.isAuthenticated">
          <RouterLink to="/citas" class="btn btn-primary btn-sm" @click="menuOpen = false">Mis Citas</RouterLink>
          <RouterLink to="/mi-cuenta" class="nav-avatar" :title="auth.usuario?.nombre">
            {{ (auth.usuario?.nombre || 'U').charAt(0).toUpperCase() }}
          </RouterLink>
          <button class="btn btn-outline btn-sm" @click="handleLogout">Salir</button>
        </template>
        <template v-else>
          <RouterLink to="/login" class="btn btn-outline btn-sm">Ingresar</RouterLink>
          <RouterLink to="/registro" class="btn btn-primary btn-sm">Registrarse</RouterLink>
        </template>

        <button class="hamburger" @click="menuOpen = !menuOpen" aria-label="Menú" :class="{ active: menuOpen }">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>

    <transition name="mobile-slide">
      <div v-if="menuOpen" class="mobile-menu">
        <RouterLink to="/servicios" @click="menuOpen = false">Servicios</RouterLink>
        <RouterLink to="/tienda" @click="menuOpen = false">Tienda</RouterLink>
        <RouterLink to="/resenas" @click="menuOpen = false">Reseñas</RouterLink>
        <RouterLink to="/contacto" @click="menuOpen = false">Contacto</RouterLink>
        <RouterLink to="/citas" v-if="auth.isAuthenticated" @click="menuOpen = false">Mis Citas</RouterLink>
        <RouterLink to="/admin/dashboard" v-if="auth.isAdmin" @click="menuOpen = false">Admin</RouterLink>
        <RouterLink to="/veterinario/dashboard" v-if="auth.isVeterinario && !auth.isAdmin" @click="menuOpen = false">Vet Panel</RouterLink>
        <hr class="mobile-hr" />
        <template v-if="auth.isAuthenticated">
          <RouterLink to="/mi-cuenta" @click="menuOpen = false">Mi Cuenta</RouterLink>
          <button class="mobile-link" @click="handleLogout">Cerrar sesión</button>
        </template>
        <template v-else>
          <RouterLink to="/login" @click="menuOpen = false">Ingresar</RouterLink>
          <RouterLink to="/registro" @click="menuOpen = false">Registrarse</RouterLink>
        </template>
      </div>
    </transition>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useAuthStore } from '../stores/auth'
import { useCartStore } from '../stores/cart'
import { useRouter } from 'vue-router'

const auth = useAuthStore()
const cart = useCartStore()
const router = useRouter()
const menuOpen = ref(false)
const isScrolled = ref(false)

onMounted(() => {
  cart.fetch().catch(() => {})
  const handleScroll = () => { isScrolled.value = window.scrollY > 20 }
  window.addEventListener('scroll', handleScroll, { passive: true })
  onUnmounted(() => window.removeEventListener('scroll', handleScroll))
})

async function handleLogout() {
  menuOpen.value = false
  await auth.logout()
  router.push('/login')
}
</script>

<style scoped>
.navbar {
  position: sticky;
  top: 0;
  z-index: 100;
  background: rgba(253, 249, 243, 0.9);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-bottom: 1px solid transparent;
  transition: border-color 0.3s, box-shadow 0.3s;
}
.navbar.scrolled {
  border-color: var(--border);
  box-shadow: 0 2px 20px rgba(7,16,10,.07);
}

.nav-inner {
  display: flex;
  align-items: center;
  gap: 1rem;
  height: 64px;
}

.logo {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  flex-shrink: 0;
  text-decoration: none;
}
.logo-mark {
  width: 28px; height: 28px;
  background: var(--forest);
  color: var(--gold-light);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  transition: background 0.2s;
}
.logo:hover .logo-mark { background: var(--deep); }
.logo-text {
  font-family: 'Fraunces', serif;
  font-size: 1.3rem;
  font-weight: 600;
  color: var(--deep);
  letter-spacing: 0.08em;
  line-height: 1;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  flex: 1;
  margin-left: 1rem;
}
.nav-links a {
  position: relative;
  font-size: 0.78rem;
  font-weight: 600;
  color: var(--text-muted);
  letter-spacing: 0.06em;
  text-transform: uppercase;
  padding: 0.4rem 0.75rem 0.5rem;
  border-radius: 6px;
  transition: color 0.2s;
  white-space: nowrap;
}
.nav-links a::after {
  content: '';
  position: absolute;
  bottom: 4px;
  left: 0.75rem;
  right: 0.75rem;
  height: 1.5px;
  background: var(--forest);
  border-radius: 1px;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.25s var(--ease-out);
}
.nav-links a:hover { color: var(--forest); }
.nav-links a:hover::after { transform: scaleX(1); }
.nav-links a.router-link-active { color: var(--forest); }
.nav-links a.router-link-active::after { transform: scaleX(1); }
.admin-link { color: var(--gold) !important; }
.admin-link::after { background: var(--gold) !important; }

.btn-panel {
  background: var(--gold);
  color: var(--deep);
  border-color: var(--gold);
  font-weight: 700;
}
.btn-panel:hover {
  background: var(--deep);
  color: var(--gold);
  border-color: var(--deep);
}

.nav-actions {
  display: flex;
  align-items: center;
  gap: 0.6rem;
}

.cart-btn {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px; height: 36px;
  border-radius: 50%;
  color: var(--text-muted);
  transition: color 0.18s, background 0.18s;
}
.cart-btn:hover {
  color: var(--forest);
  background: rgba(74,124,89,.09);
}
.cart-badge {
  position: absolute;
  top: -3px; right: -3px;
  background: var(--gold);
  color: var(--deep);
  border-radius: 9999px;
  font-size: 0.6rem;
  padding: 0.1rem 0.35rem;
  font-weight: 800;
  line-height: 1.3;
}

.nav-avatar {
  width: 32px; height: 32px;
  border-radius: 50%;
  background: var(--forest);
  color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700;
  font-size: 0.8rem;
  flex-shrink: 0;
  transition: transform 0.18s;
}
.nav-avatar:hover { transform: scale(1.08); }

.hamburger {
  display: none;
  flex-direction: column;
  gap: 4.5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0.3rem;
  width: 32px;
}
.hamburger span {
  display: block;
  height: 1.5px;
  background: var(--text);
  border-radius: 2px;
  transition: all 0.25s ease;
  transform-origin: center;
}
.hamburger.active span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
.hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.hamburger.active span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }

.mobile-menu {
  position: absolute;
  top: 64px;
  left: 0; right: 0;
  background: rgba(250,246,238,.97);
  backdrop-filter: blur(16px);
  border-top: 1px solid var(--border);
  box-shadow: 0 8px 32px rgba(12,26,14,.1);
  padding: 1rem 1.5rem 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 0.15rem;
}
.mobile-menu a,
.mobile-link {
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--text);
  display: block;
  padding: 0.65rem 0.75rem;
  border-radius: var(--radius);
  transition: background 0.15s, color 0.15s;
  background: none;
  border: none;
  cursor: pointer;
  text-align: left;
  width: 100%;
  font-family: 'Jost', sans-serif;
}
.mobile-menu a:hover,
.mobile-link:hover {
  background: rgba(74,124,89,.08);
  color: var(--forest);
}
.mobile-menu a.router-link-active { color: var(--forest); font-weight: 700; }
.mobile-hr { border: none; border-top: 1px solid var(--border); margin: 0.5rem 0; }

.mobile-slide-enter-active,
.mobile-slide-leave-active { transition: opacity 0.2s ease, transform 0.2s ease; }
.mobile-slide-enter-from,
.mobile-slide-leave-to { opacity: 0; transform: translateY(-8px); }

@media (max-width: 860px) {
  .nav-links { display: none; }
  .hamburger { display: flex; }
}
@media (max-width: 520px) {
  .nav-actions .btn { display: none; }
  .cart-btn { display: flex; }
}
</style>
