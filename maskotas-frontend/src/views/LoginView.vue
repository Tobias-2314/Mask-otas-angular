<template>
  <div class="auth-page">
    <div class="auth-card card">
      <h1>Iniciar sesión</h1>
      <form @submit.prevent="submit">
        <div class="form-group">
          <label>Email</label>
          <input type="email" v-model="form.email" required />
        </div>
        <div class="form-group">
          <label>Contraseña</label>
          <input type="password" v-model="form.password" required />
        </div>
        <div v-if="error" class="alert alert-error">{{ error }}</div>
        <button type="submit" class="btn btn-primary" style="width:100%" :disabled="loading">
          {{ loading ? 'Ingresando…' : 'Ingresar' }}
        </button>
      </form>
      <p class="switch">¿No tienes cuenta? <RouterLink to="/registro">Registrarse</RouterLink></p>
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
.auth-page { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px); padding: 2rem; }
.auth-card { width: 100%; max-width: 420px; }
.auth-card h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; }
.switch { text-align: center; margin-top: 1.25rem; font-size: .9rem; color: var(--muted); }
.switch a { color: var(--primary); font-weight: 600; }
</style>
