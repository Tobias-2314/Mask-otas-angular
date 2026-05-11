import api from './index'

export const getDashboard = () => api.get('/veterinario/dashboard')
export const getCita = (id) => api.get(`/veterinario/citas/${id}`)
export const actualizarCita = (id, data) => api.patch(`/veterinario/citas/${id}`, data)
