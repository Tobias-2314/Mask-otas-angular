import api from './index'

export const getMiCuenta = () => api.get('/usuario/mi-cuenta')
export const actualizarPerfil = (nombre, email) => api.put('/usuario/actualizar-perfil', { nombre, email })
export const actualizarPreferencias = (prefs) => api.put('/usuario/preferencias', prefs)
