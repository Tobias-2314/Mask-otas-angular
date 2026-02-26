@extends('layouts.app')

@section('contenido')

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-purple-600 to-indigo-600 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="container mx-auto px-6 py-16 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                Nuestra Tienda
            </h1>
            <p class="text-lg text-indigo-100 max-w-2xl mx-auto">
                Encuentra los mejores productos para el cuidado y la felicidad de tu mascota.
            </p>
        </div>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 flex flex-col md:flex-row gap-8">

            <!-- Sidebar Filters -->
            <aside class="md:w-1/4">
                <div class="bg-white p-6 rounded-2xl shadow-lg sticky top-24">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-filter mr-2 text-indigo-600"></i> Filtros
                    </h3>
                    <form action="{{ route('tienda') }}" method="GET">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Precio Mínimo (€)</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500"
                                placeholder="0">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Precio Máximo (€)</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500"
                                placeholder="1000">
                        </div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition">
                            Aplicar Filtros
                        </button>
                        @if(request('min_price') || request('max_price'))
                            <a href="{{ route('tienda') }}"
                                class="block text-center text-sm text-gray-500 mt-4 hover:text-indigo-600">
                                Limpiar Filtros
                            </a>
                        @endif
                    </form>
                </div>
            </aside>

            <!-- Product List -->
            <div class="md:w-3/4">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div
                            class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 overflow-hidden flex flex-col h-full">
                            <!-- Product Image -->
                            <div class="h-56 overflow-hidden relative group">
                                @if($product->image)
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                        <i class="fas fa-paw text-4xl"></i>
                                    </div>
                                @endif
                                <div
                                    class="absolute top-0 right-0 m-4 bg-indigo-600 shop-badge text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                    Nuevo
                                </div>
                            </div>

                            <!-- Product Content -->
                            <div class="p-6 flex-grow flex flex-col">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                                <p class="text-gray-600 mb-2 flex-grow text-sm">{{ Str::limit($product->description, 80) }}</p>

                                <div class="mb-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Stock: <span id="product-stock-{{ $product->id }}"
                                            class="ml-1 font-bold">{{ $product->stock }}</span>
                                    </span>
                                </div>

                                <div class="flex items-center justify-between mt-auto">
                                    <span
                                        class="text-2xl font-bold text-indigo-600 shop-price">{{ number_format($product->price, 2) }}
                                        €</span>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="ajax-cart-form">
                                        @csrf
                                        <button type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-md hover:shadow-lg flex items-center gap-2">
                                            <i class="fas fa-cart-plus"></i> Añadir al carrito
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($products->isEmpty())
                    <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
                        <p class="text-gray-500 text-xl">No se encontraron productos con estos filtros.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.ajax-cart-form');

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const button = this.querySelector('button[type="submit"]');
                    const originalContent = button.innerHTML;
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                    const formData = new FormData(this);

                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                        .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.error || 'Error al añadir al carrito');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        updateCartBadge(data.cart_count);
                        showToast(data.success);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorToast(error.message);
                })
                        .finally(() => {
                            button.disabled = false;
                            button.innerHTML = originalContent;
                        });
                });
            });

            function updateCartBadge(count) {
                const cartLink = document.getElementById('cart-link');
                let badge = document.getElementById('cart-count-badge');

                if (cartLink && count > 0) {
                    if (!badge) {
                        badge = document.createElement('span');
                        badge.id = 'cart-count-badge';
                        badge.className = 'absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white';
                        cartLink.appendChild(badge);
                    }
                    badge.textContent = count;
                } else if (badge) {
                    badge.remove();
                }
            }

            function showToast(message) {
                let container = document.getElementById('toast-container');
                if (!container) {
                    container = document.createElement('div');
                    container.id = 'toast-container';
                    container.className = 'fixed top-24 right-5 z-50 flex flex-col gap-2 pointer-events-none';
                    document.body.appendChild(container);
                }

                const toast = document.createElement('div');
                toast.className = 'bg-white border-l-4 border-green-500 rounded shadow-lg p-4 flex items-center transform transition-all duration-300 translate-x-full pointer-events-auto';
                toast.innerHTML = `
                    <div class="text-green-500 mr-3"><i class="fas fa-check-circle text-xl"></i></div>
                    <div class="text-gray-800 font-medium text-sm">${message}</div>
                `;

                container.appendChild(toast);
                requestAnimationFrame(() => {
                    setTimeout(() => toast.classList.remove('translate-x-full'), 10);
                });

                setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function showErrorToast(message) {
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'fixed top-24 right-5 z-50 flex flex-col gap-2 pointer-events-none';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.className = 'bg-white border-l-4 border-red-500 rounded shadow-lg p-4 flex items-center transform transition-all duration-300 translate-x-full pointer-events-auto';
            toast.innerHTML = `
                <div class="text-red-500 mr-3"><i class="fas fa-exclamation-circle text-xl"></i></div>
                <div class="text-gray-800 font-medium text-sm">${message}</div>
            `;

            container.appendChild(toast);
            requestAnimationFrame(() => {
                setTimeout(() => toast.classList.remove('translate-x-full'), 10);
            });

            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

            // Funcción para actualizar stocks automáticamente cada 5 segundos
            function updateStocks() {
                fetch('{{ route('api.productos.stock') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(stocks => {
                        stocks.forEach(product => {
                            const stockElement = document.getElementById(`product-stock-${product.id}`);
                            if (stockElement) {
                                const currentStock = parseInt(stockElement.textContent);
                                if (currentStock !== product.stock) {
                                    stockElement.textContent = product.stock;

                                    // Efecto visual sutil al cambiar
                                    stockElement.parentElement.classList.add('animate-pulse', 'bg-yellow-100');
                                    setTimeout(() => {
                                        stockElement.parentElement.classList.remove('animate-pulse', 'bg-yellow-100');
                                    }, 2000);
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Error al actualizar stock:', error));
            }

            // Iniciar el intervalo de 5 segundos
            setInterval(updateStocks, 5000);
        });
    </script>
@endsection