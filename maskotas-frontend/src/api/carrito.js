import api from './index'

export const getCarrito = () => api.get('/carrito')
export const agregarItem = (id) => api.post(`/carrito/agregar/${id}`)
export const eliminarItem = (id) => api.delete(`/carrito/eliminar/${id}`)
export const incrementarItem = (id) => api.patch(`/carrito/incrementar/${id}`)
export const decrementarItem = (id) => api.patch(`/carrito/decrementar/${id}`)

