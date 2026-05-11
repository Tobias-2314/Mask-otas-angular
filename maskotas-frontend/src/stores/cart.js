import { defineStore } from 'pinia'
import { ref } from 'vue'
import * as carritoApi from '../api/carrito'

export const useCartStore = defineStore('cart', () => {
  const items = ref([])
  const total = ref(0)
  const count = ref(0)

  async function fetch() {
    const { data } = await carritoApi.getCarrito()
    items.value = data.cart
    total.value = data.total
    count.value = data.count
  }

  async function agregar(id) {
    await carritoApi.agregarItem(id)
    await fetch()
  }

  async function eliminar(id) {
    await carritoApi.eliminarItem(id)
    await fetch()
  }

  async function incrementar(id) {
    await carritoApi.incrementarItem(id)
    await fetch()
  }

  async function decrementar(id) {
    await carritoApi.decrementarItem(id)
    await fetch()
  }

  return { items, total, count, fetch, agregar, eliminar, incrementar, decrementar }
})
