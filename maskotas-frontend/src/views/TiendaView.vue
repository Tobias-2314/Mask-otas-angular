<template>
  <div class="container">
    <div class="page-header">
      <h1>Tienda</h1>
      <p>Productos para tu mascota</p>
    </div>

    <div class="filters card">
      <form @submit.prevent="buscar" class="filter-row">
        <div class="form-group" style="margin:0;flex:1">
          <label>Precio mínimo</label>
          <input type="number" v-model="minPrice" placeholder="0" min="0" />
        </div>
        <div class="form-group" style="margin:0;flex:1">
          <label>Precio máximo</label>
          <input type="number" v-model="maxPrice" placeholder="Sin límite" min="0" />
        </div>
        <button type="submit" class="btn btn-primary" style="align-self:flex-end">Filtrar</button>
        <button type="button" class="btn btn-outline" style="align-self:flex-end" @click="limpiar">Limpiar</button>
      </form>
    </div>

    <div v-if="loading" class="loading">Cargando productos…</div>
    <div v-else-if="productos.length === 0" class="loading">No hay productos disponibles.</div>
    <div v-else class="productos-grid">
      <div v-for="p in productos" :key="p.id" class="card producto-card">
        <img :src="p.image || '/placeholder.png'" :alt="p.name" class="producto-img" />
        <div class="producto-body">
          <h3>{{ p.name }}</h3>
          <p class="producto-desc">{{ p.description }}</p>
          <div class="producto-footer">
            <span class="producto-price">${{ p.price }}</span>
            <span :class="['badge', p.stock > 0 ? 'badge-green' : 'badge-red']">
              {{ p.stock > 0 ? `Stock: ${p.stock}` : 'Sin stock' }}
            </span>
          </div>
          <div class="producto-actions">
            <RouterLink :to="`/tienda/${p.id}`" class="btn btn-outline btn-sm">Ver más</RouterLink>
            <button
              class="btn btn-primary btn-sm"
              :disabled="p.stock === 0 || adding === p.id"
              @click="agregar(p.id)"
            >
              {{ adding === p.id ? '…' : 'Agregar' }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="errorMsg" class="alert alert-error" style="margin-top:1rem">{{ errorMsg }}</div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getTienda } from '../api/productos'
import { useCartStore } from '../stores/cart'

const productos = ref([])
const loading = ref(true)
const minPrice = ref('')
const maxPrice = ref('')
const adding = ref(null)
const errorMsg = ref('')
const cart = useCartStore()

async function cargar() {
  loading.value = true
  try {
    const { data } = await getTienda(minPrice.value || undefined, maxPrice.value || undefined)
    productos.value = data
  } finally {
    loading.value = false
  }
}

function buscar() { cargar() }
function limpiar() { minPrice.value = ''; maxPrice.value = ''; cargar() }

async function agregar(id) {
  errorMsg.value = ''
  adding.value = id
  try {
    await cart.agregar(id)
  } catch (e) {
    errorMsg.value = e.response?.data?.error || 'Error al agregar'
  } finally {
    adding.value = null
  }
}

onMounted(cargar)
</script>

<style scoped>
.filters { margin-bottom: 1.5rem; padding: 1rem; }
.filter-row { display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap; }
.productos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1.25rem; }
.producto-card { padding: 0; overflow: hidden; display: flex; flex-direction: column; }
.producto-img { width: 100%; height: 180px; object-fit: cover; }
.producto-body { padding: 1rem; display: flex; flex-direction: column; gap: .5rem; flex: 1; }
.producto-body h3 { font-weight: 700; }
.producto-desc { font-size: .85rem; color: var(--muted); flex: 1; }
.producto-footer { display: flex; justify-content: space-between; align-items: center; }
.producto-price { font-size: 1.2rem; font-weight: 700; color: var(--primary); }
.producto-actions { display: flex; gap: .5rem; margin-top: .25rem; }
</style>
