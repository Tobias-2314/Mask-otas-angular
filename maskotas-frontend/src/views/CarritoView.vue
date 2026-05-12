<template>
  <div class="container" style="max-width:800px;padding-top:2rem">
    <div class="page-header">
      <h1>Carrito de compras</h1>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else-if="cart.items.length === 0" class="empty">
      <p>Tu carrito está vacío.</p>
      <RouterLink to="/tienda" class="btn btn-primary" style="margin-top:1rem">Ir a la tienda</RouterLink>
    </div>
    <div v-else>
      <div class="card" style="padding:0;overflow:hidden">
        <table class="table">
          <thead>
            <tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th></th></tr>
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
                  <button class="btn btn-outline btn-sm" @click="cart.decrementar(item.id)">-</button>
                  <span>{{ item.quantity }}</span>
                  <button class="btn btn-outline btn-sm" @click="cart.incrementar(item.id)">+</button>
                </div>
              </td>
              <td>${{ (item.price * item.quantity).toFixed(2) }}</td>
              <td>
                <button class="btn btn-danger btn-sm" @click="cart.eliminar(item.id)">✕</button>
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
.empty { text-align: center; padding: 3rem; color: var(--muted); }
.item-name { display: flex; align-items: center; gap: .75rem; font-weight: 500; }
.item-img { width: 42px; height: 42px; border-radius: 8px; object-fit: cover; }
.qty-ctrl { display: flex; align-items: center; gap: .5rem; }
.cart-footer {
  margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;
}
.total-label { font-size: 1.1rem; }
.total-label strong { font-size: 1.4rem; color: var(--primary); }
</style>
