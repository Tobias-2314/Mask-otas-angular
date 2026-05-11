<template>
  <div class="container" style="max-width:700px;padding-top:2rem">
    <RouterLink to="/tienda" class="btn btn-outline btn-sm" style="margin-bottom:1.5rem">← Volver</RouterLink>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else-if="!producto" class="loading">Producto no encontrado.</div>
    <div v-else class="card producto-detail">
      <img :src="producto.image || '/placeholder.png'" :alt="producto.name" class="detail-img" />
      <div class="detail-body">
        <h1>{{ producto.name }}</h1>
        <p class="desc">{{ producto.description }}</p>
        <div class="meta">
          <span class="price">${{ producto.price }}</span>
          <span :class="['badge', producto.stock > 0 ? 'badge-green' : 'badge-red']">
            {{ producto.stock > 0 ? `${producto.stock} disponibles` : 'Sin stock' }}
          </span>
        </div>
        <div v-if="msg" :class="['alert', success ? 'alert-success' : 'alert-error']">{{ msg }}</div>
        <button
          class="btn btn-primary"
          :disabled="producto.stock === 0 || loading"
          @click="agregar"
        >
          Agregar al carrito
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { getProducto } from '../api/productos'
import { useCartStore } from '../stores/cart'

const route = useRoute()
const cart = useCartStore()
const producto = ref(null)
const loading = ref(true)
const msg = ref('')
const success = ref(false)

onMounted(async () => {
  try {
    const { data } = await getProducto(route.params.id)
    producto.value = data
  } finally {
    loading.value = false
  }
})

async function agregar() {
  msg.value = ''
  try {
    await cart.agregar(route.params.id)
    msg.value = 'Producto agregado al carrito'
    success.value = true
  } catch (e) {
    msg.value = e.response?.data?.error || 'Error al agregar'
    success.value = false
  }
}
</script>

<style scoped>
.producto-detail { padding: 0; overflow: hidden; display: flex; flex-direction: column; }
.detail-img { width: 100%; max-height: 320px; object-fit: cover; }
.detail-body { padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; }
.detail-body h1 { font-size: 1.6rem; font-weight: 700; }
.desc { color: var(--muted); line-height: 1.6; }
.meta { display: flex; align-items: center; gap: 1rem; }
.price { font-size: 1.8rem; font-weight: 800; color: var(--primary); }
</style>
