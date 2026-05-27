import api from './index'

export const getDashboard = (range = 30) => api.get('/admin/dashboard', { params: { range } })

export const getUsuarios = () => api.get('/admin/usuarios')
export const crearUsuario = (usuario) => api.post('/admin/usuarios', usuario)
export const eliminarUsuario = (id) => api.delete(`/admin/usuarios/${id}`)

export const getCitas = () => api.get('/admin/citas')

export const getResenas = () => api.get('/admin/resenas')
export const eliminarResena = (id) => api.delete(`/admin/resenas/${id}`)

export const getProductos = () => api.get('/admin/productos')
export const crearProducto = (producto) => api.post('/admin/productos', producto)
export const actualizarProducto = (id, producto) => api.put(`/admin/productos/${id}`, producto)
export const eliminarProducto = (id) => api.delete(`/admin/productos/${id}`)

export const getMascotas = (search) => api.get('/admin/mascotas', { params: { search } })
export const getMascota = (id) => api.get(`/admin/mascotas/${id}`)
export const guardarHistorial = (id, data) => api.post(`/admin/mascotas/${id}/historial`, data)
