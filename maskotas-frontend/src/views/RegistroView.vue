<template>
  <div class="auth-page">
    <div class="auth-card card">
      <h1>Crear cuenta</h1>
      <form @submit.prevent="submit">
        <div class="form-group">
          <label>Nombre</label>
          <input type="text" v-model="form.nombre" required />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" v-model="form.email" required />
        </div>
        <div class="form-group">
          <label>Contraseña</label>
          <input type="password" v-model="form.password" required minlength="6" />
        </div>
        <div class="form-group">
          <label>Confirmar contraseña</label>
          <input type="password" v-model="form.password_confirmation" required />
        </div>
        <div v-if="error" class="alert alert-error">{{ error }}</div>
        <button type="submit" class="btn btn-primary" style="width:100%" :disabled="loading">
          {{ loading ? 'Registrando…' : 'Registrarse' }}
        </button>
      </form>
      <p class="switch">¿Ya tienes cuenta? <RouterLink to="/login">Ingresar</RouterLink></p>
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
.auth-page { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px); padding: 2rem; }
.auth-card { width: 100%; max-width: 420px; }
.auth-card h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; }
.switch { text-align: center; margin-top: 1.25rem; font-size: .9rem; color: var(--muted); }
.switch a { color: var(--primary); font-weight: 600; }
</style>
