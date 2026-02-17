@extends('layouts.app')

@section('contenido')
<div class="min-h-screen bg-gray-50 py-12 relative">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Finalizar Compra</h1>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Resumen del Pedido -->
            <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md h-fit order-2 md:order-1">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Resumen del Pedido</h2>
                <div id="checkout-items" class="space-y-4 mb-4 text-gray-600">
                    <!-- Items se cargarán con JS -->
                </div>
                <div class="border-t pt-4">
                    <div class="flex justify-between items-center font-bold text-lg text-gray-800">
                        <span>Total a Pagar:</span>
                        <span id="checkout-total">0.00 €</span>
                    </div>
                </div>
            </div>

            <!-- Formulario de Pago -->
            <div class="w-full md:w-2/3 bg-white p-6 rounded-lg shadow-md order-1 md:order-2">
                
                <!-- Visual Credit Card -->
                <div class="mb-8 flex justify-center">
                    <div class="w-full max-w-sm h-56 bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl relative shadow-2xl text-white p-6 transition-transform transform hover:scale-105 duration-300">
                        
                        <div class="flex justify-between items-center mb-8">
                            <i class="fas fa-microchip text-4xl text-yellow-500"></i>
                            <i class="fab fa-cc-visa text-4xl"></i>
                        </div>
                        
                        <div class="mb-6">
                            <label class="text-xs text-gray-400 uppercase tracking-widest">Número de Tarjeta</label>
                            <div id="card-number-display" class="font-mono text-2xl tracking-widest drop-shadow-md">#### #### #### ####</div>
                        </div>
                        
                        <div class="flex justify-between">
                            <div>
                                <label class="text-xs text-gray-400 uppercase tracking-widest">Titular</label>
                                <div id="card-holder-display" class="font-medium uppercase tracking-wide truncate w-40">NOMBRE APELLIDO</div>
                            </div>
                            <div>
                                <label class="text-xs text-gray-400 uppercase tracking-widest">Expira</label>
                                <div id="card-expiry-display" class="font-mono font-medium">MM/YY</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="text-xl font-semibold mb-6 border-b pb-2">Datos de Pago (Simulado)</h2>
                
                <form id="payment-form">
                    @csrf
                    <input type="hidden" name="items" id="items-input">
                    <input type="hidden" name="total" id="total-input">

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nombre en la tarjeta</label>
                        <input type="text" id="card-holder-input" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" placeholder="Como aparece en la tarjeta" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Número de Tarjeta</label>
                        <input type="text" name="card_number" id="card-number-input" maxlength="19" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-mono" placeholder="0000 0000 0000 0000" required>
                    </div>

                    <div class="flex gap-4 mb-6">
                        <div class="w-1/2">
                            <label class="block text-gray-700 font-bold mb-2">Expiración</label>
                            <input type="text" name="card_expiry" id="card-expiry-input" maxlength="5" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-center" placeholder="MM/YY" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-gray-700 font-bold mb-2">CVC</label>
                            <input type="text" name="card_cvc" maxlength="3" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-center" placeholder="123" required pattern="\d{3}">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-lg hover:bg-indigo-700 transition transform active:scale-95 shadow-lg flex justify-center items-center gap-2">
                        <span>Pagar Ahora</span>
                        <i class="fas fa-lock"></i>
                    </button>
                    <p class="text-xs text-center text-gray-500 mt-4 flex items-center justify-center gap-1">
                        <i class="fas fa-shield-alt text-green-500"></i>
                        Pago seguro simulado. No se realizará ningún cargo real.
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- Overlay de Carga -->
    <div id="loading-overlay" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex flex-col items-center justify-center">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-indigo-500 mb-4"></div>
        <h2 class="text-white text-2xl font-bold animate-pulse">Procesando Pago...</h2>
        <p class="text-gray-300 mt-2">Por favor no cierres la ventana</p>
    </div>

    <!-- Modal de Éxito -->
    <div id="success-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full text-center shadow-2xl transform scale-100 transition-transform">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-4xl text-green-500"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">¡Pago Realizado con Éxito!</h2>
            <p class="text-gray-600 mb-6">Gracias por tu compra. Hemos enviado la confirmación a tu correo.</p>
            <div class="bg-gray-50 rounded p-4 mb-6 text-sm text-gray-500">
                ID de Pedido: <span id="success-order-id" class="font-mono font-bold text-gray-800">#12345678</span>
            </div>
            <a href="{{ route('mi-cuenta') }}" class="block w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition">
                Ver Mis Pedidos
            </a>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Lógica del Carrito ---
        // Recuperamos el carrito pasado desde el controlador (convertido a array de JS)
        const cartObj = @json($cart);
        // Convertimos el objeto de sesión a array si es necesario, o lo usamos directamente
        const cart = Object.values(cartObj); 
        
        const checkoutItems = document.getElementById('checkout-items');
        const checkoutTotal = document.getElementById('checkout-total');
        const itemsInput = document.getElementById('items-input');
        const totalInput = document.getElementById('total-input');

        if (cart.length === 0) {
            checkoutItems.innerHTML = '<p class="text-gray-500 text-center py-4">El carrito está vacío.</p>';
        } else {
            let total = 0;
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
                const div = document.createElement('div');
                div.className = 'flex justify-between items-center text-sm border-b border-gray-100 last:border-0 pb-2 last:pb-0';
                div.innerHTML = `
                    <div class="flex items-center gap-2">
                         <span class="font-bold text-gray-700 bg-gray-100 px-2 py-0.5 rounded text-xs">${item.quantity}x</span>
                         <span>${item.name}</span>
                    </div>
                    <span class="font-medium">${itemTotal.toFixed(2)} €</span>
                `;
                checkoutItems.appendChild(div);
            });

            checkoutTotal.textContent = total.toFixed(2) + ' €';
            itemsInput.value = JSON.stringify(cart);
            totalInput.value = total.toFixed(2);
        }

        // --- Visual Card Logic ---
        const cardNumInput = document.getElementById('card-number-input');
        const cardDisplay = document.getElementById('card-number-display');
        
        cardNumInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '').substring(0, 16);
            let formatted = value.match(/.{1,4}/g)?.join(' ') || '';
            e.target.value = formatted;
            cardDisplay.textContent = formatted || '#### #### #### ####';
        });

        const cardHolderInput = document.getElementById('card-holder-input');
        const holderDisplay = document.getElementById('card-holder-display');

        cardHolderInput.addEventListener('input', (e) => {
            holderDisplay.textContent = e.target.value || 'NOMBRE APELLIDO';
        });

        const cardExpiryInput = document.getElementById('card-expiry-input');
        const expiryDisplay = document.getElementById('card-expiry-display');

        cardExpiryInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '').substring(0, 4);
            if (value.length >= 2) value = value.substring(0, 2) + '/' + value.substring(2);
            e.target.value = value;
            expiryDisplay.textContent = value || 'MM/YY';
        });

        // --- Form Submission ---
        const form = document.getElementById('payment-form');
        const loadingOverlay = document.getElementById('loading-overlay');
        const successModal = document.getElementById('success-modal');
        const successOrderId = document.getElementById('success-order-id');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            if (cart.length === 0) {
                alert('El carrito está vacío');
                return;
            }

            // Mostrar carga
            loadingOverlay.classList.remove('hidden');

            try {
                // Simular delay de red
                await new Promise(resolve => setTimeout(resolve, 2500));

                const formData = new FormData(form);
                
                // Limpiar número de tarjeta (quitar espacios)
                const cardNumber = formData.get('card_number').replace(/\s/g, '');
                formData.set('card_number', cardNumber);

                // Enviar al backend real
                const response = await fetch("{{ route('checkout.store') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    loadingOverlay.classList.add('hidden');
                    localStorage.removeItem('cart'); // Limpiar carrito
                    successOrderId.textContent = '#' + String(data.order_id).substring(0, 8).toUpperCase();
                    successModal.classList.remove('hidden');
                } else {
                    throw new Error(data.message || 'Error en el pago');
                }

            } catch (error) {
                loadingOverlay.classList.add('hidden');
                alert('Error processing payment: ' + error.message);
                console.error(error);
            }
        });
    });
</script>
@endsection
