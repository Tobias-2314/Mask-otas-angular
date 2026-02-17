@extends('layouts.app')

@section('contenido')
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900">Panel de Administración</h1>
                <p class="text-gray-600 mt-2">Bienvenido, {{ Auth::user()->nombre }}</p>
            </div>

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Usuarios -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Usuarios</p>
                            <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalUsuarios }}</p>
                        </div>
                        <div class="bg-indigo-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Citas -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Citas</p>
                            <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalCitas }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Citas Pendientes -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Citas Pendientes</p>
                            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $citasPendientes }}</p>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Reseñas -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Reseñas</p>
                            <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalResenas }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                
                <!-- Columna Izquierda: Accesos Rápidos -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6 h-full">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Accesos Rápidos</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="{{ route('admin.usuarios') }}"
                                class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                                <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-bold text-gray-900">Usuarios</p>
                                    <p class="text-xs text-gray-600">Gestionar usuarios</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.citas') }}"
                                class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                                <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-bold text-gray-900">Citas</p>
                                    <p class="text-xs text-gray-600">Gestionar agenda</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.resenas') }}"
                                class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                                <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-bold text-gray-900">Reseñas</p>
                                    <p class="text-xs text-gray-600">Moderar opiniones</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.productos') }}"
                                class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition">
                                <svg class="w-8 h-8 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <div>
                                    <p class="font-bold text-gray-900">Productos</p>
                                    <p class="text-xs text-gray-600">Inventario tienda</p>
                                </div>
                            </a>

                            <a href="{{ route('mascotas.create') }}"
                                class="flex items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition">
                                <svg class="w-8 h-8 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <div>
                                    <p class="font-bold text-gray-900">Nueva Mascota</p>
                                    <p class="text-xs text-gray-600">Registro rápido</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.mascotas') }}"
                                class="flex items-center p-4 bg-teal-50 rounded-lg hover:bg-teal-100 transition">
                                <svg class="w-8 h-8 text-teal-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-bold text-gray-900">Historiales</p>
                                    <p class="text-xs text-gray-600">Médico veterinario</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.design') }}"
                                class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-bold text-gray-900">Diseño</p>
                                    <p class="text-xs text-gray-600">Apariencia web</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha: Gráfico de Ventas (Más pequeño) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 h-full flex flex-col">
                        <div class="mb-4">
                            <h2 class="text-lg font-bold text-gray-900">Ventas</h2>
                            <!-- Filtros Compactos -->
                            <div class="flex flex-wrap gap-1 mt-2">
                                <a href="{{ route('admin.dashboard', ['range' => 5]) }}" 
                                class="flex-1 text-center px-2 py-1 text-xs font-medium rounded border {{ $range == 5 ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : 'text-gray-500 border-gray-200 hover:bg-gray-50' }}">
                                    5d
                                </a>
                                <a href="{{ route('admin.dashboard', ['range' => 30]) }}" 
                                class="flex-1 text-center px-2 py-1 text-xs font-medium rounded border {{ $range == 30 ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : 'text-gray-500 border-gray-200 hover:bg-gray-50' }}">
                                    30d
                                </a>
                                <a href="{{ route('admin.dashboard', ['range' => 365]) }}" 
                                class="flex-1 text-center px-2 py-1 text-xs font-medium rounded border {{ $range == 365 ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : 'text-gray-500 border-gray-200 hover:bg-gray-50' }}">
                                    1a
                                </a>
                            </div>
                        </div>
                        
                        <div class="relative flex-grow min-h-[200px]">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            
            // Datos pasados desde el controlador
            const labels = @json($chartLabels);
            const data = @json($chartData);
            
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ventas (€)',
                        data: data,
                        backgroundColor: 'rgba(79, 70, 229, 0.2)', // Indigo-600 with opacity
                        borderColor: 'rgba(79, 70, 229, 1)', // Indigo-600
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(255, 255, 255, 1)',
                        pointBorderColor: 'rgba(79, 70, 229, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.3 // Curva suave
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleFont: {
                                size: 13
                            },
                            bodyFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            padding: 10,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [2, 4],
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + ' €';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        });
    </script>
@endsection