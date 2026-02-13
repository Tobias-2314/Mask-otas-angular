@extends('layouts.app')

@section('contenido')
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-gray-900 mb-8">Personalización del Diseño</h1>

            @if (session('exito'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('exito') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.design.update') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-lg shadow-md p-6">
                @csrf

                <!-- Branding Section -->
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Identidad & Branding</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Logo del Sitio</label>
                        <input type="file" name="logo_upload"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @if(isset($settings['logo_image']) && !empty($settings['logo_image']))
                            <div class="mt-2 flex items-center gap-4">
                                <div>
                                    <div class="text-sm text-gray-500">Logo actual:</div>
                                    <img src="{{ $settings['logo_image'] }}" class="h-12 mt-1 bg-gray-100 rounded p-1">
                                </div>
                                <button type="button" onclick="document.getElementById('delete-logo-form').submit()"
                                    class="text-red-600 hover:text-red-800 text-sm font-bold underline">
                                    Eliminar Logo
                                </button>
                            </div>
                        @endif
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Imagen Hero (Inicio)</label>
                        <input type="file" name="hero_image_upload"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @if(isset($settings['hero_image']) && !empty($settings['hero_image']))
                            <div class="mt-2 text-sm text-gray-500">Imagen actual:</div>
                            <img src="{{ $settings['hero_image'] }}" class="h-20 mt-1 rounded object-cover">
                        @endif
                    </div>
                </div>

                <!-- Colors Section -->
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Paleta de Colores</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Primario (Indigo)</label>
                        <div class="flex items-center">
                            <input type="color" name="primary_color" value="{{ $settings['primary_color'] ?? '#4F46E5' }}"
                                class="h-10 w-20 border rounded mr-4 cursor-pointer">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Secundario (Verde/Púrpura)</label>
                        <div class="flex items-center">
                            <input type="color" name="secondary_color"
                                value="{{ $settings['secondary_color'] ?? '#10B981' }}"
                                class="h-10 w-20 border rounded mr-4 cursor-pointer">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fondo General</label>
                        <div class="flex items-center">
                            <input type="color" name="background_color"
                                value="{{ $settings['background_color'] ?? '#F9FAFB' }}"
                                class="h-10 w-20 border rounded mr-4 cursor-pointer">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fondo Header</label>
                        <div class="flex items-center">
                            <input type="color" name="header_bg_color"
                                value="{{ $settings['header_bg_color'] ?? '#FFFFFF' }}"
                                class="h-10 w-20 border rounded mr-4 cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- Typography Section -->
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Tipografía</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fuente Principal</label>
                        <select name="font_family"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Outfit" {{ ($settings['font_family'] ?? '') == 'Outfit' ? 'selected' : '' }}>Outfit
                                (Miderna, Default)</option>
                            <option value="Roboto" {{ ($settings['font_family'] ?? '') == 'Roboto' ? 'selected' : '' }}>Roboto
                            </option>
                            <option value="Open Sans" {{ ($settings['font_family'] ?? '') == 'Open Sans' ? 'selected' : '' }}>
                                Open Sans</option>
                            <option value="Merriweather" {{ ($settings['font_family'] ?? '') == 'Merriweather' ? 'selected' : '' }}>Merriweather (Serif)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tamaño Base</label>
                        <select name="base_font_size"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="small" {{ ($settings['base_font_size'] ?? '') == 'small' ? 'selected' : '' }}>
                                Pequeño (14px)</option>
                            <option value="medium" {{ ($settings['base_font_size'] ?? '') == 'medium' ? 'selected' : '' }}>
                                Mediano (16px - Default)</option>
                            <option value="large" {{ ($settings['base_font_size'] ?? '') == 'large' ? 'selected' : '' }}>
                                Grande (18px)</option>
                        </select>
                    </div>
                </div>
                <!-- Heading Color Removed -->

                <!-- UI Components Section -->
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Componentes UI</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Forma de Botones</label>
                        <select name="button_shape"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="rounded" {{ ($settings['button_shape'] ?? '') == 'rounded' ? 'selected' : '' }}>
                                Redondeados (Default)</option>
                            <option value="pill" {{ ($settings['button_shape'] ?? '') == 'pill' ? 'selected' : '' }}>Píldora
                                (Full)</option>
                            <option value="square" {{ ($settings['button_shape'] ?? '') == 'square' ? 'selected' : '' }}>
                                Cuadrados</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Color Texto Botones</label>
                        <div class="flex items-center">
                            <input type="color" name="button_text_color"
                                value="{{ $settings['button_text_color'] ?? '#FFFFFF' }}"
                                class="h-10 w-20 border rounded mr-4 cursor-pointer">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Sombras de Tarjetas</label>
                        <select name="card_shadow"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="none" {{ ($settings['card_shadow'] ?? '') == 'none' ? 'selected' : '' }}>Sin Sombra
                            </option>
                            <option value="soft" {{ ($settings['card_shadow'] ?? '') == 'soft' ? 'selected' : '' }}>Suave
                            </option>
                            <option value="shadow-lg" {{ ($settings['card_shadow'] ?? '') == 'shadow-lg' ? 'selected' : '' }}>
                                Media (Default)</option>
                            <option value="hard" {{ ($settings['card_shadow'] ?? '') == 'hard' ? 'selected' : '' }}>Intensa
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Section Specifics Removed (Shop & Details) -->

                <!-- Footer Section -->
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Pie de Página (Footer)</h2>
                <div class="grid grid-cols-1 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fondo Footer</label>
                        <div class="flex items-center mb-4">
                            <input type="color" name="footer_bg_color"
                                value="{{ $settings['footer_bg_color'] ?? '#111827' }}"
                                class="h-10 w-20 border rounded mr-4 cursor-pointer">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Texto del Footer</label>
                            <textarea name="footer_text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                rows="3">{{ $settings['footer_text'] ?? 'Cuidamos a quienes más amas...' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Info Contacto</label>
                            <input type="text" name="footer_address" value="{{ $settings['footer_address'] ?? '' }}"
                                placeholder="Dirección"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight mb-2 focus:outline-none focus:shadow-outline">
                            <input type="email" name="footer_email" value="{{ $settings['footer_email'] ?? '' }}"
                                placeholder="Email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition transform hover:scale-105">
                        Guardar Cambios
                    </button>
                </div>
            </form>

            <form id="delete-logo-form" action="{{ route('admin.design.logo.delete') }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection