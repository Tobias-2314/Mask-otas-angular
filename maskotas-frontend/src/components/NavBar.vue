<template>
  <nav class="navbar">
    <div class="container nav-inner">
      <RouterLink to="/" class="logo">🐾 Maskotas</RouterLink>

      <div class="nav-links">
        <RouterLink to="/tienda">Tienda</RouterLink>
        <RouterLink to="/citas" v-if="auth.isAuthenticated">Citas</RouterLink>
        <RouterLink to="/admin/dashboard" v-if="auth.isAdmin">Admin</RouterLink>
        <RouterLink to="/veterinario/dashboard" v-if="auth.isVeterinario && !auth.isAdmin">Vet Panel</RouterLink>
      </div>

      <div class="nav-actions">
        <RouterLink to="/carrito" class="cart-btn">
          🛒 <span v-if="cart.count > 0" class="cart-badge">{{ cart.count }}</span>
        </RouterLink>

        <template v-if="auth.isAuthenticated">
          <RouterLink to="/mi-cuenta" class="btn btn-outline btn-sm">{{ auth.usuario?.nombre }}</RouterLink>
          <button class="btn btn-outline btn-sm" @click="handleLogout">Salir</button>
        </template>
        <template v-else>
          <RouterLink to="/login" class="btn btn-outline btn-sm">Ingresar</RouterLink>
          <RouterLink to="/registro" class="btn btn-primary btn-sm">Registrarse</RouterLink>
        </template>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { useAuthStore } from '../stores/auth'
import { useCartStore } from '../stores/cart'
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'

const auth = useAuthStore()
const cart = useCartStore()
const router = useRouter()

onMounted(() => cart.fetch().catch(() => {}))

async function handleLogout() {
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
.nav-links a { font-size: .9rem; font-weight: 500; color: var(--muted); transition: color .15s; }
.nav-links a:hover, .nav-links a.router-link-active { color: var(--primary); }
.nav-actions { display: flex; align-items: center; gap: .75rem; }
.cart-btn { position: relative; font-size: 1.2rem; }
.cart-badge {
  position: absolute; top: -6px; right: -8px;
  background: var(--accent); color: #fff;
  border-radius: 99px; font-size: .65rem; padding: .1rem .35rem;
  font-weight: 700;
}
</style>
