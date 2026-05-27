<template>
  <div class="auth-layout">
    <div class="auth-brand">
      <div class="brand-content">
        <div class="brand-logo">MASKOTAS</div>
        <!-- Texto decorativo del panel lateral — no es un encabezado de sección -->
        <p class="brand-title">Crea tu <em>cuenta</em></p>
        <p class="brand-desc">Únete a nuestra comunidad y accede a todos los servicios de la clínica de forma rápida y sencilla.</p>
        <div class="brand-features">
          <div class="bf-item" v-for="f in features" :key="f">
            <span class="bf-dot"></span>{{ f }}
          </div>
        </div>
      </div>
      <div class="brand-orb"></div>
    </div>

    <div class="auth-form-panel">
      <div class="auth-form-inner">
        <RouterLink to="/" class="back-link">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
          Volver al inicio
        </RouterLink>

        <div class="form-header">
          <h1>Registrarse</h1>
          <p>Completa los datos para crear tu cuenta</p>
        </div>

        <form @submit.prevent="submit" class="auth-form">
          <div class="form-group">
            <label for="reg-nombre">Nombre completo</label>
            <input
              id="reg-nombre"
              type="text"
              v-model="form.nombre"
              required
              placeholder="Tu nombre"
              autocomplete="name"
              :aria-invalid="error ? 'true' : 'false'"
            />
          </div>
          <div class="form-group">
            <label for="reg-email">Email</label>
            <input
              id="reg-email"
              type="email"
              v-model="form.email"
              required
              placeholder="tu@email.com"
              autocomplete="email"
              :aria-invalid="error ? 'true' : 'false'"
            />
          </div>
          <div class="form-group">
            <label for="reg-password">Contraseña</label>
            <input
              id="reg-password"
              type="password"
              v-model="form.password"
              required
              placeholder="Mínimo 6 caracteres"
              minlength="6"
              autocomplete="new-password"
              :aria-invalid="error ? 'true' : 'false'"
            />
          </div>
          <div class="form-group">
            <label for="reg-confirm">Confirmar contraseña</label>
            <input
              id="reg-confirm"
              type="password"
              v-model="form.password_confirmation"
              required
              placeholder="Repite tu contraseña"
              autocomplete="new-password"
              :aria-invalid="error ? 'true' : 'false'"
            />
          </div>

          <!-- role="alert" anuncia el error a lectores de pantalla -->
          <div v-if="error" class="alert alert-error" role="alert" aria-live="assertive">{{ error }}</div>

          <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
            <span v-if="loading" class="spinner"></span>
            {{ loading ? 'Registrando…' : 'Crear Cuenta' }}
          </button>
        </form>

        <p class="switch-link">
          ¿Ya tienes cuenta?
          <RouterLink to="/login">Ingresar</RouterLink>
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
const form = ref({ nombre: '', email: '', password: '', password_confirmation: '' })
const error = ref('')
const loading = ref(false)

const features = [
  'Agenda citas en minutos',
  'Registra el historial de tus mascotas',
  'Recibe recordatorios y notificaciones',
]

async function submit() {
  error.value = ''
  if (form.value.password !== form.value.password_confirmation) {
    error.value = 'Las contraseñas no coinciden'
    return
  }
  loading.value = true
  try {
    await auth.registro(form.value.nombre, form.value.email, form.value.password, form.value.password_confirmation)
    router.push('/')
  } catch (e) {
    error.value = e.response?.data?.error || 'Error al registrarse'
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
  background: var(--forest);
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
  background: var(--deep);
  opacity: 0.4;
  filter: blur(80px);
  top: -100px; left: -80px;
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
.brand-desc { font-size: 0.93rem; color: rgba(250,246,238,.65); line-height: 1.75; margin-bottom: 2rem; }
.brand-features { display: flex; flex-direction: column; gap: 0.65rem; }
.bf-item { display: flex; align-items: center; gap: 0.7rem; font-size: 0.85rem; color: rgba(250,246,238,.75); }
.bf-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--gold); flex-shrink: 0; }

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
.form-header h1 { font-size: 2.2rem; font-weight: 600; color: var(--deep); margin-bottom: 0.4rem; }
.form-header p { font-size: 0.9rem; color: var(--text-muted); }

.auth-form { display: flex; flex-direction: column; }
.btn-block { width: 100%; justify-content: center; padding: 0.85rem; }

.switch-link { text-align: center; margin-top: 1.5rem; font-size: 0.88rem; color: var(--text-muted); }
.switch-link a { color: var(--forest); font-weight: 700; margin-left: 0.25rem; }
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
