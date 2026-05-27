import api from './index'

export const login = (email, password) => api.post('/auth/login', { email, password })
export const registro = (nombre, email, password, password_confirmation) =>
  api.post('/auth/registro', { nombre, email, password, password_confirmation })
export const logout = () => api.post('/auth/logout')
export const me = () => api.get('/auth/me')
