<template>
  <div>
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">Tienda</span>
        <h1>Todo para <em>tu mascota</em></h1>
        <p>Productos de calidad seleccionados especialmente para el bienestar de tu mejor amigo.</p>
      </div>
    </section>

    <section class="tienda-main">
      <div class="container">
        <!-- Filtros -->
        <div class="filters-bar">
          <form @submit.prevent="buscar" class="filters-form">
            <div class="filter-group">
              <label>Precio mín.</label>
              <input type="number" v-model="minPrice" placeholder="0" min="0" />
            </div>
            <div class="filter-group">
              <label>Precio máx.</label>
              <input type="number" v-model="maxPrice" placeholder="Sin límite" min="0" />
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
            <button type="button" class="btn btn-outline btn-sm" @click="limpiar">Limpiar</button>
          </form>
        </div>

        <div v-if="loading" class="loading">Cargando productos…</div>
        <div v-else-if="productos.length === 0" class="empty-state">
          <div class="empty-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </div>
          <p>No se encontraron productos.</p>
        </div>
        <div v-else class="productos-grid">
          <div v-for="p in productos" :key="p.id" class="producto-card">
            <RouterLink :to="`/tienda/${p.id}`" class="producto-img-wrap">
              <img :src="p.image || '/placeholder.png'" :alt="p.name" class="producto-img" />
              <div class="producto-overlay">
                <span>Ver detalles</span>
              </div>
              <span :class="['stock-badge', p.stock > 0 ? 'in-stock' : 'no-stock']">
                {{ p.stock > 0 ? `${p.stock} disponibles` : 'Sin stock' }}
              </span>
            </RouterLink>
            <div class="producto-info">
              <h3>{{ p.name }}</h3>
              <p class="producto-desc">{{ p.description }}</p>
              <div class="producto-footer">
                <span class="producto-price">${{ p.price }}</span>
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

        <div v-if="errorMsg" class="alert alert-error" style="margin-top:1.5rem">{{ errorMsg }}</div>
      </div>
    </section>
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
.page-hero {
  background: var(--deep);
  color: var(--cream);
  padding: 4.5rem 0 3.5rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.page-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 30% 60%, rgba(26,61,31,.7) 0%, transparent 65%);
  pointer-events: none;
}
.page-hero .container { position: relative; z-index: 1; }
.eyebrow {
  display: inline-block;
  font-size: 0.72rem;
  font-weight: 800;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--gold-light);
  margin-bottom: 0.65rem;
}
.page-hero h1 {
  font-size: clamp(2rem, 4.5vw, 3.5rem);
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 0.85rem;
}
.page-hero h1 em { font-style: italic; color: var(--gold-light); }
.page-hero p { color: rgba(250,246,238,.65); max-width: 480px; margin: 0 auto; font-size: 0.97rem; line-height: 1.7; }

.tienda-main { padding: 3.5rem 0 5rem; background: var(--cream); }

.filters-bar {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 1rem 1.5rem;
  margin-bottom: 2.5rem;
}
.filters-form {
  display: flex;
  gap: 1rem;
  align-items: flex-end;
  flex-wrap: wrap;
}
.filter-group {
  display: flex;
  flex-direction: column;
  gap: 0.3rem;
}
.filter-group label {
  font-size: 0.7rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-muted);
}
.filter-group input {
  padding: 0.5rem 0.85rem;
  border: 1.5px solid var(--border);
  border-radius: var(--radius);
  font-size: 0.9rem;
  font-family: 'Plus Jakarta Sans', sans-serif;
  width: 140px;
  transition: border-color 0.18s;
}
.filter-group input:focus { outline: none; border-color: var(--sage); }

.empty-state {
  text-align: center;
  padding: 5rem 0;
  color: var(--text-muted);
}
.empty-icon {
  width: 72px; height: 72px;
  border-radius: 50%;
  background: var(--parchment);
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 1.25rem;
  color: var(--mint);
}
.empty-state p { font-family: 'Cormorant Garamond', serif; font-size: 1.2rem; font-style: italic; }

.productos-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 1.5rem;
}
.producto-card {
  background: #fff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  overflow: hidden;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.producto-card:hover { transform: translateY(-5px); box-shadow: var(--shadow); }

.producto-img-wrap {
  position: relative;
  display: block;
  overflow: hidden;
  aspect-ratio: 4/3;
}
.producto-img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.producto-card:hover .producto-img { transform: scale(1.05); }
.producto-overlay {
  position: absolute;
  inset: 0;
  background: rgba(12,26,14,.4);
  display: flex; align-items: center; justify-content: center;
  opacity: 0;
  transition: opacity 0.25s ease;
}
.producto-overlay span {
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: #fff;
  padding: 0.45rem 1rem;
  border: 1.5px solid rgba(255,255,255,.7);
  border-radius: 9999px;
}
.producto-card:hover .producto-overlay { opacity: 1; }

.stock-badge {
  position: absolute;
  top: 0.75rem; left: 0.75rem;
  font-size: 0.65rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 0.2rem 0.6rem;
  border-radius: 9999px;
}
.in-stock  { background: #dcfce7; color: #166534; }
.no-stock  { background: #fee2e2; color: #991b1b; }

.producto-info { padding: 1.25rem 1.25rem 1.5rem; }
.producto-info h3 {
  font-size: 1.05rem;
  font-weight: 600;
  color: var(--deep);
  margin-bottom: 0.4rem;
}
.producto-desc {
  font-size: 0.83rem;
  color: var(--text-muted);
  line-height: 1.6;
  margin-bottom: 1rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.producto-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.producto-price {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--forest);
}
</style>
