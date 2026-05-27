<template>
  <div class="producto-page">
    <div class="container">
      <RouterLink to="/tienda" class="back-link">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Volver a la tienda
      </RouterLink>

      <div v-if="loading" class="loading">Cargando producto…</div>
      <div v-else-if="!producto" class="loading">Producto no encontrado.</div>
      <div v-else class="producto-detail">
        <div class="producto-img-col">
          <div class="producto-img-wrap">
            <img :src="producto.image || '/placeholder.png'" :alt="producto.name" class="producto-img" />
          </div>
        </div>
        <div class="producto-info-col">
          <span :class="['stock-pill', producto.stock > 0 ? 'in-stock' : 'no-stock']">
            {{ producto.stock > 0 ? `${producto.stock} disponibles` : 'Sin stock' }}
          </span>
          <h1>{{ producto.name }}</h1>
          <div class="producto-price">${{ producto.price }}</div>
          <p class="producto-desc">{{ producto.description }}</p>

          <div v-if="msg" :class="['alert', success ? 'alert-success' : 'alert-error']">{{ msg }}</div>

          <button
            class="btn btn-primary btn-lg add-btn"
            :disabled="producto.stock === 0 || loading"
            @click="agregar"
          >
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            Agregar al carrito
          </button>
        </div>
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
.producto-page { padding: 2.5rem 0 5rem; background: var(--cream); min-height: calc(100vh - 64px); }

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 0.3rem;
  font-size: 0.78rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--text-muted);
  margin-bottom: 2.5rem;
  transition: color 0.18s;
}
.back-link:hover { color: var(--forest); }

.producto-detail {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: start;
}
@media (max-width: 680px) {
  .producto-detail { grid-template-columns: 1fr; gap: 2rem; }
}

.producto-img-wrap {
  border-radius: var(--radius-xl);
  overflow: hidden;
  aspect-ratio: 1;
  background: var(--parchment);
}
.producto-img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.producto-img-wrap:hover .producto-img { transform: scale(1.03); }

.producto-info-col { padding-top: 0.5rem; }
.stock-pill {
  display: inline-flex;
  align-items: center;
  padding: 0.22rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.7rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  margin-bottom: 1rem;
}
.in-stock { background: #dcfce7; color: #166534; }
.no-stock { background: #fee2e2; color: #991b1b; }

.producto-info-col h1 {
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 600;
  color: var(--deep);
  margin-bottom: 0.75rem;
}
.producto-price {
  font-family: 'Cormorant Garamond', serif;
  font-size: 2.4rem;
  font-weight: 700;
  color: var(--forest);
  margin-bottom: 1.25rem;
  line-height: 1;
}
.producto-desc {
  font-size: 0.97rem;
  color: var(--text-muted);
  line-height: 1.75;
  margin-bottom: 2rem;
}
.add-btn { gap: 0.6rem; }
</style>
