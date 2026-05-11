import api from './index'

export const getTienda = (minPrice, maxPrice) => api.get('/tienda', { params: { minPrice, maxPrice } })
export const getStock = () => api.get('/productos/stock')
export const getProducto = (id) => api.get(`/productos/${id}`)
