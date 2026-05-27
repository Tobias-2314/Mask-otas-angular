import api from './index'

export const getMascotas = () => api.get('/mascotas')
export const crearMascota = (mascota) => api.post('/mascotas', mascota)
export const eliminarMascota = (id) => api.delete(`/mascotas/${id}`)
