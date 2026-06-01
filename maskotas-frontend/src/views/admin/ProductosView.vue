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
      <h1>Productos</h1>
      <button class="btn btn-primary btn-sm" @click="abrirForm()">+ Nuevo producto</button>
    </div>

    <div v-if="showForm" class="card" style="margin-bottom:1.5rem">
      <h2 class="section-head">{{ editando ? 'Editar' : 'Nuevo' }} producto</h2>
      <form @submit.prevent="guardar">
        <div class="form-row">
          <div class="form-group"><label>Nombre</label><input v-model="form.nombre" required /></div>
          <div class="form-group"><label>Precio</label><input type="number" step="0.01" v-model="form.precio" required /></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label>Stock</label><input type="number" v-model="form.stock" required /></div>
          <div class="form-group">
            <label>Imagen (URL)</label>
            <input v-model="form.imagen" placeholder="https://..." />
            <img v-if="form.imagen" :src="form.imagen" class="img-preview" alt="preview" />
          </div>
        </div>
        <div class="form-group"><label>Descripción</label><textarea v-model="form.descripcion" rows="2"></textarea></div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary btn-sm" :disabled="saving">{{ saving ? '…' : 'Guardar' }}</button>
          <button type="button" class="btn btn-outline btn-sm" @click="showForm = false">Cancelar</button>
        </div>
      </form>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else class="card table-card">
      <table class="table">
        <thead><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th></th></tr></thead>
        <tbody>
          <tr v-for="p in productos" :key="p.id">
            <td>#{{ p.id }}</td>
            <td>{{ p.name }}</td>
            <td>${{ p.price }}</td>
            <td>{{ p.stock }}</td>
            <td class="row-actions">
              <button class="btn btn-outline btn-sm" @click="abrirForm(p)">Editar</button>
              <button class="btn btn-danger btn-sm" @click="eliminar(p.id)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getProductos, crearProducto, actualizarProducto, eliminarProducto } from '../../api/admin'

const productos = ref([])
const loading = ref(true)
const showForm = ref(false)
const editando = ref(null)
const saving = ref(false)
const form = ref({ nombre: '', precio: '', stock: '', imagen: '', descripcion: '' })

async function cargar() {
  loading.value = true
  const { data } = await getProductos()
  productos.value = data
  loading.value = false
}

function abrirForm(p = null) {
  editando.value = p?.id || null
  form.value = p
    ? { nombre: p.name, precio: p.price, stock: p.stock, imagen: p.imagen || '', descripcion: p.descripcion || '' }
    : { nombre: '', precio: '', stock: '', imagen: '', descripcion: '' }
  showForm.value = true
}

async function guardar() {
  saving.value = true
  try {
    if (editando.value) {
      await actualizarProducto(editando.value, form.value)
    } else {
      await crearProducto(form.value)
    }
    showForm.value = false
    await cargar()
  } finally {
    saving.value = false
  }
}

async function eliminar(id) {
  if (!confirm('¿Eliminar producto?')) return
  await eliminarProducto(id)
  await cargar()
}

onMounted(cargar)
</script>

<style scoped>
.img-preview {
  display: block;
  margin-top: 0.5rem;
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 6px;
  border: 1px solid var(--border);
}
</style>
