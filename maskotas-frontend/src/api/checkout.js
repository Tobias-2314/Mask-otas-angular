import api from './index'

export const realizarCheckout = (body = {}) => api.post('/checkout', body)
