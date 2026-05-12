<template>
  <nav class="navbar">
    <div class="container nav-inner">
      <RouterLink to="/" class="logo">🐾 Maskotas</RouterLink>

      <div class="nav-links" :class="{ open: menuOpen }">
        <RouterLink to="/servicios" @click="menuOpen = false">Servicios</RouterLink>
        <RouterLink to="/tienda" @click="menuOpen = false">Tienda</RouterLink>
        <RouterLink to="/resenas" @click="menuOpen = false">Reseñas</RouterLink>
        <RouterLink to="/contacto" @click="menuOpen = false">Contacto</RouterLink>
        <RouterLink to="/citas" v-if="auth.isAuthenticated" @click="menuOpen = false">Citas</RouterLink>
        <RouterLink to="/admin/dashboard" v-if="auth.isAdmin" @click="menuOpen = false">Admin</RouterLink>
        <RouterLink to="/veterinario/dashboard" v-if="auth.isVeterinario && !auth.isAdmin" @click="menuOpen = false">Vet Panel</RouterLink>
      </div>

      <div class="nav-actions">
        <RouterLink to="/carrito" class="cart-btn">
          🛒 <span v-if="cart.count > 0" class="cart-badge">{{ cart.count }}</span>
        </RouterLink>

        <template v-if="auth.isAuthenticated">
          <RouterLink to="/mi-cuenta" class="btn btn-outline btn-sm user-btn">{{ auth.usuario?.nombre }}</RouterLink>
          <button class="btn btn-outline btn-sm" @click="handleLogout">Salir</button>
        </template>
        <template v-else>
          <RouterLink to="/login" class="btn btn-outline btn-sm">Ingresar</RouterLink>
          <RouterLink to="/registro" class="btn btn-primary btn-sm">Registrarse</RouterLink>
        </template>

        <button class="hamburger" @click="menuOpen = !menuOpen" aria-label="Menú">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>

    <!-- Mobile menu overlay -->
    <div v-if="menuOpen" class="mobile-menu">
      <RouterLink to="/servicios" @click="menuOpen = false">Servicios</RouterLink>
      <RouterLink to="/tienda" @click="menuOpen = false">Tienda</RouterLink>
      <RouterLink to="/resenas" @click="menuOpen = false">Reseñas</RouterLink>
      <RouterLink to="/contacto" @click="menuOpen = false">Contacto</RouterLink>
      <RouterLink to="/citas" v-if="auth.isAuthenticated" @click="menuOpen = false">Citas</RouterLink>
      <RouterLink to="/admin/dashboard" v-if="auth.isAdmin" @click="menuOpen = false">Admin</RouterLink>
      <RouterLink to="/veterinario/dashboard" v-if="auth.isVeterinario && !auth.isAdmin" @click="menuOpen = false">Vet Panel</RouterLink>
      <div class="mobile-divider"></div>
      <template v-if="auth.isAuthenticated">
        <RouterLink to="/mi-cuenta" @click="menuOpen = false">Mi Cuenta</RouterLink>
        <button class="mobile-link" @click="handleLogout">Cerrar sesión</button>
      </template>
      <template v-else>
        <RouterLink to="/login" @click="menuOpen = false">Ingresar</RouterLink>
        <RouterLink to="/registro" @click="menuOpen = false">Registrarse</RouterLink>
      </template>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '../stores/auth'
import { useCartStore } from '../stores/cart'
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'

const auth = useAuthStore()
const cart = useCartStore()
const router = useRouter()
const menuOpen = ref(false)

onMounted(() => cart.fetch().catch(() => {}))

async function handleLogout() {
  menuOpen.value = false
  await auth.logout()
  router.push('/login')
}
</script>

<style scoped>
.navbar {
  position: sticky; top: 0; z-index: 100;
  background: #fff; border-bottom: 1px solid var(--border);
  box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.nav-inner {
  display: flex; align-items: center; gap: 1.5rem;
  height: 60px;
}
.logo { font-weight: 700; font-size: 1.2rem; color: var(--primary); flex-shrink: 0; }
.nav-links { display: flex; gap: 1.25rem; flex: 1; }
.nav-links a { font-size: .9rem; font-weight: 500; color: var(--muted); transition: color .15s; white-space: nowrap; }
.nav-links a:hover, .nav-links a.router-link-active { color: var(--primary); }
.nav-actions { display: flex; align-items: center; gap: .75rem; }
.cart-btn { position: relative; font-size: 1.2rem; }
.cart-badge {
  position: absolute; top: -6px; right: -8px;
  background: var(--accent); color: #fff;
  border-radius: 99px; font-size: .65rem; padding: .1rem .35rem;
  font-weight: 700;
}
.user-btn { max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

.hamburger {
  display: none; flex-direction: column; gap: 4px;
  background: none; border: none; cursor: pointer; padding: .3rem;
}
.hamburger span { display: block; width: 22px; height: 2px; background: var(--text); border-radius: 2px; }

.mobile-menu {
  display: none;
  position: absolute; top: 60px; left: 0; right: 0;
  background: #fff; border-top: 1px solid var(--border);
  box-shadow: 0 4px 12px rgba(0,0,0,.1);
  z-index: 99; padding: 1rem 1.5rem;
  flex-direction: column; gap: .75rem;
}
.mobile-menu a, .mobile-link {
  font-size: .95rem; font-weight: 500; color: var(--text);
  text-decoration: none; display: block; padding: .4rem 0;
  background: none; border: none; cursor: pointer; text-align: left;
}
.mobile-menu a:hover, .mobile-link:hover { color: var(--primary); }
.mobile-divider { border-top: 1px solid var(--border); margin: .25rem 0; }

@media (max-width: 768px) {
  .nav-links { display: none; }
  .hamburger { display: flex; }
  .mobile-menu { display: flex; }
}
</style>
