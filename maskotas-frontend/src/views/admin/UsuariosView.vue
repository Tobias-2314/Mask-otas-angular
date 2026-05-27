<template>
  <div class="container admin-page">
    <nav class="admin-nav">
      <RouterLink to="/admin/dashboard" class="admin-link">Dashboard</RouterLink>
      <RouterLink to="/admin/productos" class="admin-link">Productos</RouterLink>
      <RouterLink to="/admin/usuarios" class="admin-link">Usuarios</RouterLink>
      <RouterLink to="/admin/citas" class="admin-link">Citas</RouterLink>
      <RouterLink to="/admin/mascotas" class="admin-link">Mascotas</RouterLink>
      <RouterLink to="/admin/resenas" class="admin-link">Reseñas</RouterLink>
    </nav>

    <div class="admin-header">
      <h1>Usuarios</h1>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else class="card table-card">
      <table class="table">
        <thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th></th></tr></thead>
        <tbody>
          <tr v-for="u in usuarios" :key="u.id">
            <td>#{{ u.id }}</td>
            <td>{{ u.nombre }}</td>
            <td>{{ u.email }}</td>
            <td><span :class="['badge', roleBadge(u.role)]">{{ u.role }}</span></td>
            <td>
              <button class="btn btn-danger btn-sm" @click="eliminar(u.id)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getUsuarios, eliminarUsuario } from '../../api/admin'

const usuarios = ref([])
const loading = ref(true)

function roleBadge(role) {
  if (role?.includes('ADMIN')) return 'badge-red'
  if (role?.includes('VETERINARIO')) return 'badge-blue'
  return 'badge-gray'
}

async function cargar() {
  const { data } = await getUsuarios()
  usuarios.value = data
  loading.value = false
}

async function eliminar(id) {
  if (!confirm('¿Eliminar usuario?')) return
  await eliminarUsuario(id)
  await cargar()
}

onMounted(cargar)
</script>
