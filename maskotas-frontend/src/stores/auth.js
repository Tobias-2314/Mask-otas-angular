import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import * as authApi from '../api/auth'

export const useAuthStore = defineStore('auth', () => {
  const usuario = ref(null)
  const checked = ref(false)

  const isAuthenticated = computed(() => !!usuario.value)
  const isAdmin = computed(() => usuario.value?.role === 'ROLE_ADMIN')
  const isVeterinario = computed(() => usuario.value?.role === 'ROLE_VETERINARIO' || isAdmin.value)

  async function fetchMe() {
    try {
      const { data } = await authApi.me()
      usuario.value = data.authenticated ? data.usuario : null
    } catch {
      usuario.value = null
    } finally {
      checked.value = true
    }
  }

  async function login(email, password) {
    const { data } = await authApi.login(email, password)
    usuario.value = data.usuario
    return data
  }

  async function registro(nombre, email, password, passwordConfirmation) {
    const { data } = await authApi.registro(nombre, email, password, passwordConfirmation)
    usuario.value = data.usuario
    return data
  }

  async function logout() {
    await authApi.logout()
    usuario.value = null
  }

  return { usuario, checked, isAuthenticated, isAdmin, isVeterinario, fetchMe, login, registro, logout }
})
