import api from './index'

export const enviarMensaje = (message) => api.post('/chat', { message })
