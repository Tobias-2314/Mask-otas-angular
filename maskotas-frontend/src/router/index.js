import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const routes = [
  { path: '/', component: () => import('../views/HomeView.vue') },
  { path: '/tienda', component: () => import('../views/TiendaView.vue') },
  { path: '/tienda/:id', component: () => import('../views/ProductoView.vue') },
  { path: '/carrito', component: () => import('../views/CarritoView.vue') },
  { path: '/login', component: () => import('../views/LoginView.vue'), meta: { guest: true } },
  { path: '/registro', component: () => import('../views/RegistroView.vue'), meta: { guest: true } },
  {
    path: '/citas',
    component: () => import('../views/CitasView.vue'),
    meta: { auth: true }
  },
  {
    path: '/mi-cuenta',
    component: () => import('../views/MiCuentaView.vue'),
    meta: { auth: true }
  },
  {
    path: '/admin',
    meta: { role: 'ROLE_ADMIN' },
    children: [
      { path: '', redirect: '/admin/dashboard' },
      { path: 'dashboard', component: () => import('../views/admin/DashboardView.vue') },
      { path: 'productos', component: () => import('../views/admin/ProductosView.vue') },
      { path: 'usuarios', component: () => import('../views/admin/UsuariosView.vue') },
      { path: 'citas', component: () => import('../views/admin/CitasView.vue') },
      { path: 'mascotas', component: () => import('../views/admin/MascotasView.vue') }
    ]
  },
  {
    path: '/veterinario',
    meta: { role: 'ROLE_VETERINARIO' },
    children: [
      { path: '', redirect: '/veterinario/dashboard' },
      { path: 'dashboard', component: () => import('../views/veterinario/DashboardView.vue') },
      { path: 'citas/:id', component: () => import('../views/veterinario/CitaView.vue') }
    ]
  }
]

const router = createRouter({ history: createWebHistory(), routes })

router.beforeEach(async (to) => {
  const auth = useAuthStore()
  if (!auth.checked) await auth.fetchMe()

  if (to.meta.guest && auth.isAuthenticated) return '/'
  if (to.meta.auth && !auth.isAuthenticated) return '/login'
  if (to.meta.role === 'ROLE_ADMIN' && !auth.isAdmin) return '/'
  if (to.meta.role === 'ROLE_VETERINARIO' && !auth.isVeterinario) return '/'
})



export default router
