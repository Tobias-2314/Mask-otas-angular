<template>
  <div class="container" style="max-width:960px;padding-top:2rem">
    <div class="page-header" style="text-align:center"><h1>Finalizar Compra</h1></div>

    <div v-if="cart.items.length === 0" class="empty-cart">
      <p>Tu carrito está vacío.</p>
      <RouterLink to="/tienda" class="btn btn-primary" style="margin-top:1rem">Ir a la tienda</RouterLink>
    </div>

    <div v-else class="checkout-layout">
      <!-- Resumen del pedido -->
      <div class="order-summary card">
        <h2>Resumen del Pedido</h2>
        <div class="summary-items">
          <div v-for="item in cart.items" :key="item.id" class="summary-item">
            <span class="qty-badge">{{ item.quantity }}x</span>
            <span class="item-name">{{ item.name }}</span>
            <span class="item-subtotal">${{ (item.price * item.quantity).toFixed(2) }}</span>
          </div>
        </div>
        <div class="summary-total">
          <span>Total a Pagar</span>
          <strong>${{ cart.total }}</strong>
        </div>
      </div>

      <!-- Formulario de pago -->
      <div class="payment-section">
        <!-- Tarjeta visual -->
        <div class="credit-card">
          <div class="card-top">
            <span class="chip">💳</span>
            <span class="card-brand">VISA</span>
          </div>
          <div class="card-number-display">{{ cardDisplay }}</div>
          <div class="card-bottom">
            <div>
              <div class="card-label">Titular</div>
              <div class="card-holder-display">{{ form.titular || 'NOMBRE APELLIDO' }}</div>
            </div>
            <div>
              <div class="card-label">Expira</div>
              <div>{{ form.expiracion || 'MM/YY' }}</div>
            </div>
          </div>
        </div>

        <div class="card" style="margin-top:1.5rem">
          <h2 style="font-size:1rem;font-weight:700;margin-bottom:1.25rem">Datos de Pago (Simulado)</h2>

          <div v-if="exito" class="alert alert-success" style="text-align:center">
            <div style="font-size:2rem;margin-bottom:.5rem">✓</div>
            <strong>¡Pago realizado con éxito!</strong><br>
            Pedido <code>#{{ ordenId }}</code> confirmado.
            <div style="margin-top:1rem">
              <RouterLink to="/mi-cuenta" class="btn btn-primary">Ver Mis Pedidos</RouterLink>
            </div>
          </div>

          <form v-else @submit.prevent="pagar">
            <div class="form-group">
              <label>Nombre en la tarjeta</label>
              <input v-model="form.titular" required placeholder="Como aparece en la tarjeta" @input="form.titular = form.titular.toUpperCase()" />
            </div>
            <div class="form-group">
              <label>Número de Tarjeta</label>
              <input v-model="form.numero" required placeholder="0000 0000 0000 0000" maxlength="19" @input="formatNumero" class="mono" />
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Expiración</label>
                <input v-model="form.expiracion" required placeholder="MM/YY" maxlength="5" @input="formatExpiracion" class="mono" style="text-align:center" />
              </div>
              <div class="form-group">
                <label>CVC</label>
                <input v-model="form.cvc" required placeholder="123" maxlength="3" pattern="\d{3}" class="mono" style="text-align:center" />
              </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;padding:.9rem" :disabled="procesando">
              {{ procesando ? 'Procesando…' : 'Pagar Ahora 🔒' }}
            </button>
            <p style="text-align:center;font-size:.75rem;color:var(--muted);margin-top:.75rem">
              Pago seguro simulado. No se realizará ningún cargo real.
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useCartStore } from '../stores/cart'
import { realizarCheckout } from '../api/checkout'

const cart = useCartStore()
const procesando = ref(false)
const exito = ref(false)
const ordenId = ref('')

const form = reactive({ titular: '', numero: '', expiracion: '', cvc: '' })

const cardDisplay = computed(() => form.numero || '#### #### #### ####')

function formatNumero(e) {
  let v = e.target.value.replace(/\D/g, '').substring(0, 16)
  form.numero = v.match(/.{1,4}/g)?.join(' ') || ''
}

function formatExpiracion(e) {
  let v = e.target.value.replace(/\D/g, '').substring(0, 4)
  if (v.length >= 2) v = v.substring(0, 2) + '/' + v.substring(2)
  form.expiracion = v
}

async function pagar() {
  procesando.value = true
  try {
    await new Promise(r => setTimeout(r, 1800))
    const { data } = await realizarCheckout({ items: cart.items, total: cart.total })
    ordenId.value = String(data.orderId || data.id || '').substring(0, 8).toUpperCase()
    exito.value = true
    await cart.fetch()
  } catch (e) {
    alert(e.response?.data?.error || 'Error al procesar el pago')
  } finally {
    procesando.value = false
  }
}
</script>

<style scoped>
.empty-cart { text-align: center; padding: 4rem; color: var(--muted); }

.checkout-layout {
  display: grid;
  grid-template-columns: 1fr 1.5fr;
  gap: 2rem;
  align-items: start;
}
@media (max-width: 700px) { .checkout-layout { grid-template-columns: 1fr; } }

.order-summary h2, .payment-section h2 { font-size: 1.1rem; font-weight: 800; margin-bottom: 1rem; }
.summary-items { display: flex; flex-direction: column; gap: .6rem; margin-bottom: 1rem; }
.summary-item { display: flex; align-items: center; gap: .6rem; font-size: .9rem; }
.qty-badge { background: #f3f4f6; border-radius: 6px; padding: .1rem .5rem; font-size: .8rem; font-weight: 700; }
.item-name { flex: 1; color: var(--muted); }
.item-subtotal { font-weight: 600; }
.summary-total { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); padding-top: .75rem; font-size: 1rem; }
.summary-total strong { font-size: 1.3rem; color: var(--primary); }

.credit-card {
  background: linear-gradient(135deg, #1e1b4b, #312e81);
  color: #fff;
  border-radius: 16px;
  padding: 1.5rem;
  box-shadow: 0 8px 32px rgba(49,46,129,.35);
}
.card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
.chip { font-size: 1.8rem; }
.card-brand { font-size: 1.5rem; font-weight: 900; letter-spacing: .05em; }
.card-number-display { font-family: monospace; font-size: 1.3rem; letter-spacing: .2em; margin-bottom: 1.25rem; }
.card-bottom { display: flex; justify-content: space-between; }
.card-label { font-size: .65rem; text-transform: uppercase; letter-spacing: .08em; opacity: .7; margin-bottom: .15rem; }
.card-holder-display { font-weight: 600; font-size: .95rem; letter-spacing: .04em; text-transform: uppercase; }

.mono { font-family: monospace; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
</style>
