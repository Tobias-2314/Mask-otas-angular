<template>
  <div class="container carrito-container">
    <div class="page-header">
      <h1>Carrito de compras</h1>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else-if="cart.items.length === 0" class="empty">
      <p>Tu carrito está vacío.</p>
      <RouterLink to="/tienda" class="btn btn-primary btn-empty-cta">Ir a la tienda</RouterLink>
    </div>
    <div v-else>
      <div class="card" style="padding:0;overflow:hidden">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Producto</th>
              <th scope="col">Precio</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Subtotal</th>
              <th scope="col"><span class="sr-only">Acciones</span></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in cart.items" :key="item.id">
              <td>
                <div class="item-name">
                  <img v-if="item.image" :src="item.image" :alt="item.name" class="item-img" />
                  {{ item.name }}
                </div>
              </td>
              <td>${{ item.price }}</td>
              <td>
                <div class="qty-ctrl">
                  <button class="btn btn-outline btn-sm" @click="cart.decrementar(item.id)" :aria-label="`Reducir cantidad de ${item.name}`">-</button>
                  <span aria-live="polite" aria-label="Cantidad">{{ item.quantity }}</span>
                  <button class="btn btn-outline btn-sm" @click="cart.incrementar(item.id)" :aria-label="`Aumentar cantidad de ${item.name}`">+</button>
                </div>
              </td>
              <td>${{ (item.price * item.quantity).toFixed(2) }}</td>
              <td>
                <button class="btn btn-danger btn-sm" @click="cart.eliminar(item.id)" :aria-label="`Eliminar ${item.name} del carrito`">✕</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="cart-footer card">
        <span class="total-label">Total: <strong>${{ cart.total }}</strong></span>
        <RouterLink to="/checkout" class="btn btn-primary">Finalizar compra</RouterLink>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useCartStore } from '../stores/cart'

const cart = useCartStore()
const loading = ref(true)

onMounted(async () => {
  await cart.fetch()
  loading.value = false
})
</script>

<style scoped>
/* Texto solo para lectores de pantalla */
.sr-only {
  position: absolute;
  width: 1px; height: 1px;
  padding: 0; margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  white-space: nowrap;
  border: 0;
}
.carrito-container { max-width: 800px; padding-top: 2rem; }
.empty { text-align: center; padding: 3rem; color: var(--muted); }
.btn-empty-cta { margin-top: 1rem; }
.item-name { display: flex; align-items: center; gap: .75rem; font-weight: 500; }
.item-img { width: 42px; height: 42px; border-radius: 8px; object-fit: cover; }
.qty-ctrl { display: flex; align-items: center; gap: .5rem; }
.cart-footer {
  margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;
}
.total-label { font-size: 1.1rem; }
.total-label strong { font-size: 1.4rem; color: var(--primary); }
</style>
