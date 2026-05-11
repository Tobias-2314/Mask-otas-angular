import api from './index'

export const getOcupadas = () => api.get('/citas/ocupadas')
export const crearCita = (cita) => api.post('/citas', cita)
export const getMisCitas = () => api.get('/citas')
export const getCita = (id) => api.get(`/citas/${id}`)
export const actualizarCita = (id, cita) => api.put(`/citas/${id}`, cita)
export const actualizarEstado = (id, estado) => api.patch(`/citas/${id}/estado`, { estado })
export const eliminarCita = (id) => api.delete(`/citas/${id}`)
