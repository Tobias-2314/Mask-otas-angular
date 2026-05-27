import api from './index'

export const getUltimas = () => api.get('/resenas/ultimas')
export const getResenas = () => api.get('/resenas')
export const crearResena = (calificacion, comentario) => api.post('/resenas', { calificacion, comentario })
