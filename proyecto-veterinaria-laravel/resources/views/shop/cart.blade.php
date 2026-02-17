@extends('layouts.app')

@section('contenido')

    <div class="relative bg-gradient-to-r from-purple-600 to-indigo-600 text-white overflow-hidden py-10">
        <div class="container mx-auto px-6 text-center z-10 relative">
            <h1 class="text-4xl font-extrabold mb-2">Tu Carrito de Compras</h1>
            <p class="text-indigo-100">Revisa tus productos antes de finalizar la compra.</p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-10">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('cart'))
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6">Producto</th>
                            <th class="py-3 px-6 text-center">Precio</th>
                            <th class="py-3 px-6 text-center">Cantidad</th>
                            <th class="py-3 px-6 text-center">Subtotal</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach(session('cart') as $id => $details)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-3">
                                            <img class="w-12 h-12 rounded border border-gray-200" src="{{ $details['image'] }}"
                                                alt="{{ $details['name'] }}">
                                        </div>
                                        <span class="font-medium">{{ $details['name'] }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ number_format($details['price'], 2) }} €
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex justify-center items-center">
                                        <form action="{{ route('cart.decrement', $id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-gray-500 hover:text-indigo-600 focus:outline-none focus:text-indigo-600 bg-gray-200 hover:bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold transition">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </form>
                                        <span
                                            class="mx-3 bg-indigo-100 text-indigo-600 py-1 px-3 rounded-full text-xs font-bold">{{ $details['quantity'] }}</span>
                                        <form action="{{ route('cart.increment', $id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-gray-500 hover:text-indigo-600 focus:outline-none focus:text-indigo-600 bg-gray-200 hover:bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold transition">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center font-bold">
                                    {{ number_format($details['price'] * $details['quantity'], 2) }} €
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 bg-red-100 hover:bg-red-200 font-bold py-1 px-3 rounded text-sm transition flex items-center gap-1 mx-auto">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-6 bg-gray-50 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center">
                    <a href="{{ route('tienda') }}" class="text-indigo-600 font-semibold hover:underline mb-4 md:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i> Seguir Comprando
                    </a>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-800 mb-4">
                            Total: <span class="text-indigo-600">
                                @php $total = 0 @endphp
                                @foreach((array) session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                @endforeach
                                {{ number_format($total, 2) }} €
                            </span>
                        </div>
                        <button onclick="handleCheckout()"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1">
                            Proceder al Pago
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-lg shadow-lg">
                <div class="text-gray-300 mb-4">
                    <i class="fas fa-shopping-cart text-6xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Tu carrito está vacío</h2>
                <p class="text-gray-500 mb-8">¡Explora nuestra tienda y encuentra lo mejor para tu mascota!</p>
                <a href="{{ route('tienda') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition">
                    Ir a la Tienda
                </a>
            </div>
        @endif
    </div>

    <!-- Modal para Usuarios No Registrados -->
    <div id="guest-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-x-hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 transition-opacity bg-gray-900/80 backdrop-blur-sm" onclick="closeModal('guest-modal')"></div>
        
        <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl transform transition-all p-8 sm:p-10">
            <div class="flex flex-col items-center">
                <div class="flex items-center justify-center w-20 h-20 mb-6 bg-indigo-100 rounded-full">
                    <i class="fas fa-shopping-bag text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-4" id="modal-title">¡Casi listo!</h3>
                <p class="text-gray-600 text-center mb-8 font-medium">Para proceder con el pago y asegurar tus productos, por favor inicia sesión o crea una cuenta.</p>
                
                <div class="flex flex-col w-full gap-4">
                    <a href="{{ route('login') }}" class="flex items-center justify-center w-full py-4 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                    </a>
                    <a href="{{ route('registro') }}" class="flex items-center justify-center w-full py-4 px-6 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold rounded-2xl transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i> Registrarse
                    </a>
                    <button onclick="closeModal('guest-modal')" class="mt-2 text-gray-400 hover:text-gray-600 text-sm font-semibold transition">
                        Continuar mirando
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Éxito para Usuarios Registrados -->
    <div id="success-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-x-hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 transition-opacity bg-gray-900/80 backdrop-blur-sm" onclick="closeModal('success-modal')"></div>
        
        <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl transform transition-all overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-20 h-20 mb-6 bg-green-100 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-4xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 text-center mb-4" id="modal-title">¡Éxito!</h3>
                    <p class="text-gray-600 text-center mb-8 font-medium text-lg">Tu compra se ha procesado correctamente.<br>¡Gracias por elegir <strong>MASK!OTAS</strong>!</p>
                    
                    <button onclick="closeModal('success-modal')" class="flex items-center justify-center w-full py-4 px-6 bg-green-600 hover:bg-green-700 text-white font-bold rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                        Cerrar ahora
                    </button>
                </div>
            </div>
            <!-- Barra de progreso para auto-cierre -->
            <div class="absolute bottom-0 left-0 h-1.5 bg-green-100 w-full">
                <div id="auto-close-progress" class="h-full bg-green-500 transition-all duration-[5000ms] ease-linear w-0"></div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    let modalTimer;

    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        if (id === 'success-modal') {
            const progressBar = document.getElementById('auto-close-progress');
            // Reset progress bar
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            
            // Trigger animation
            setTimeout(() => {
                progressBar.style.transition = 'width 5000ms linear';
                progressBar.style.width = '100%';
            }, 10);

            clearTimeout(modalTimer);
            modalTimer = setTimeout(() => {
                closeModal('success-modal');
            }, 5000);
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
            if (id === 'success-modal') {
                clearTimeout(modalTimer);
            }
        }
    }

    function handleCheckout() {
        @auth
            window.location.href = "{{ route('checkout.create') }}";
        @else
            openModal('guest-modal');
        @endauth
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal('guest-modal');
            closeModal('success-modal');
        }
    });
</script>
@endsection