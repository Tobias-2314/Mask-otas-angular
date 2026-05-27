<template>
  <div class="auth-layout">
    <!-- Panel izquierdo -->
    <div class="auth-brand">
      <div class="brand-content">
        <div class="brand-logo">MASKOTAS</div>
        <!-- Texto decorativo del panel lateral — no es un encabezado de sección -->
        <p class="brand-title">Bienvenido<br><em>de vuelta</em></p>
        <p class="brand-desc">Tu clínica veterinaria de confianza. Accede a tu cuenta para gestionar citas y el cuidado de tu mascota.</p>
        <div class="brand-features">
          <div class="bf-item" v-for="f in features" :key="f">
            <span class="bf-dot"></span>
            {{ f }}
          </div>
        </div>
      </div>
      <div class="brand-orb"></div>
    </div>

    <!-- Formulario -->
    <div class="auth-form-panel">
      <div class="auth-form-inner">
        <RouterLink to="/" class="back-link">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
          Volver al inicio
        </RouterLink>

        <div class="form-header">
          <h1>Iniciar sesión</h1>
          <p>Ingresa tus credenciales para continuar</p>
        </div>

        <form @submit.prevent="submit" class="auth-form">
          <div class="form-group">
            <label for="login-email">Email</label>
            <input
              id="login-email"
              type="email"
              v-model="form.email"
              required
              placeholder="tu@email.com"
              autocomplete="email"
              :aria-invalid="error ? 'true' : 'false'"
            />
          </div>
          <div class="form-group">
            <label for="login-password">Contraseña</label>
            <input
              id="login-password"
              type="password"
              v-model="form.password"
              required
              placeholder="••••••••"
              autocomplete="current-password"
              :aria-invalid="error ? 'true' : 'false'"
            />
          </div>

          <!-- role="alert" anuncia el error a lectores de pantalla -->
          <div v-if="error" class="alert alert-error" role="alert" aria-live="assertive">{{ error }}</div>

          <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
            <span v-if="loading" class="spinner"></span>
            {{ loading ? 'Ingresando…' : 'Ingresar' }}
          </button>
        </form>

        <p class="switch-link">
          ¿No tienes cuenta?
          <RouterLink to="/registro">Registrarse</RouterLink>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const auth = useAuthStore()
const router = useRouter()
const form = ref({ email: '', password: '' })
const error = ref('')
const loading = ref(false)

const features = [
  'Gestiona citas online fácilmente',
  'Historial médico de tus mascotas',
  'Tienda de productos de calidad',
]

async function submit() {
  error.value = ''
  loading.value = true
  try {
    const data = await auth.login(form.value.email, form.value.password)
    router.push(data.redirect || '/')
  } catch (e) {
    error.value = e.response?.data?.error || 'Credenciales inválidas'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.auth-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: calc(100vh - 64px);
}
@media (max-width: 760px) {
  .auth-layout { grid-template-columns: 1fr; }
  .auth-brand { display: none; }
}

.auth-brand {
  background: var(--deep);
  padding: 3rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  position: relative;
  overflow: hidden;
}
.brand-orb {
  position: absolute;
  width: 400px; height: 400px;
  border-radius: 50%;
  background: var(--forest);
  opacity: 0.35;
  filter: blur(80px);
  bottom: -120px; right: -80px;
  pointer-events: none;
}
.brand-content { position: relative; z-index: 1; max-width: 380px; }
.brand-logo {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.2rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  color: var(--gold-light);
  margin-bottom: 2.5rem;
}
.brand-title {
  font-size: clamp(2.2rem, 4vw, 3.2rem);
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 1rem;
  line-height: 1.1;
}
.brand-title em { font-style: italic; color: var(--gold-light); }
.brand-desc {
  font-size: 0.93rem;
  color: rgba(250,246,238,.6);
  line-height: 1.75;
  margin-bottom: 2rem;
}
.brand-features { display: flex; flex-direction: column; gap: 0.65rem; }
.bf-item {
  display: flex;
  align-items: center;
  gap: 0.7rem;
  font-size: 0.85rem;
  color: rgba(250,246,238,.7);
}
.bf-dot {
  width: 6px; height: 6px;
  border-radius: 50%;
  background: var(--gold);
  flex-shrink: 0;
}

.auth-form-panel {
  background: var(--cream);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 3rem 2rem;
}
.auth-form-inner { width: 100%; max-width: 400px; }

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 0.3rem;
  font-size: 0.78rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--text-muted);
  margin-bottom: 2.5rem;
  transition: color 0.18s;
}
.back-link:hover { color: var(--forest); }

.form-header { margin-bottom: 2rem; }
.form-header h1 {
  font-size: 2.2rem;
  font-weight: 600;
  color: var(--deep);
  margin-bottom: 0.4rem;
}
.form-header p { font-size: 0.9rem; color: var(--text-muted); }

.auth-form { display: flex; flex-direction: column; }
.btn-block { width: 100%; justify-content: center; padding: 0.85rem; }

.switch-link {
  text-align: center;
  margin-top: 1.5rem;
  font-size: 0.88rem;
  color: var(--text-muted);
}
.switch-link a {
  color: var(--forest);
  font-weight: 700;
  margin-left: 0.25rem;
  transition: color 0.15s;
}
.switch-link a:hover { color: var(--deep); }

.spinner {
  display: inline-block;
  width: 14px; height: 14px;
  border: 2px solid rgba(255,255,255,.35);
  border-top-color: #fff;
  border-radius: 50%;
  animation: spin 0.7s linear infinite;
  margin-right: 0.25rem;
}
@keyframes spin { to { transform: rotate(360deg); } }
</style>
