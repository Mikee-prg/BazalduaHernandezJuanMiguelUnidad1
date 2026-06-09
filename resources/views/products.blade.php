<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-3xl text-red-700">
                    <i class="fas fa-shopping-bag"></i> Catálogo de Productos
                </h2>
                <p class="text-gray-600 text-sm mt-1">Descubre nuestra colección completa de acordeones y accesorios</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- FILTROS --}}
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-search text-red-700"></i> Buscar Productos
                        </label>
                        <input type="text"
                            placeholder="Busca acordeones, refacciones..."
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-700 transition">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-tag text-red-700"></i> Categoría
                        </label>
                        <select class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-700 transition">
                            <option>Todas</option>
                            <option>Acordeones</option>
                            <option>Refacciones</option>
                            <option>Accesorios</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-dollar-sign text-red-700"></i> Precio
                        </label>
                        <select class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-700 transition">
                            <option>Todos</option>
                            <option>Menos de $500</option>
                            <option>$500 - $1000</option>
                            <option>Más de $1000</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- GRID DE PRODUCTOS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

                @php
                $productos = [
                    [
                        'img'        => 'images/AcordeonGabba.png',
                        'alt'        => 'Acordeón Gabbanelli G 12 Bajos',
                        'badge'      => '-15%',
                        'badge_color'=> 'bg-red-500',
                        'nombre'     => 'Acordeón Gabbanelli G 12 Bajos',
                        'desc'       => 'Acordeón profesional de alta calidad con sonido excepcional',
                        'estrellas'  => 4.5,
                        'opiniones'  => 245,
                        'precio'     => '$899',
                        'tachado'    => '$1,049',
                    ],
                    [
                        'img'        => 'images/acordeonrojo.png',
                        'alt'        => 'Acordeón Profesional 12 Bajos',
                        'badge'      => 'Nuevo',
                        'badge_color'=> 'bg-green-500',
                        'nombre'     => 'Acordeón Profesional 12 Bajos',
                        'desc'       => 'Modelo premium para acordeonistas profesionales',
                        'estrellas'  => 5,
                        'opiniones'  => 189,
                        'precio'     => '$1,599',
                        'tachado'    => null,
                    ],
                    [
                        'img'        => 'images/Fuelle.png',
                        'alt'        => 'Fuelles Premium para Acordeón',
                        'badge'      => '-20%',
                        'badge_color'=> 'bg-red-500',
                        'nombre'     => 'Fuelles Premium para Acordeón',
                        'desc'       => 'Fuelles de alta calidad con resistencia superior',
                        'estrellas'  => 4,
                        'opiniones'  => 156,
                        'precio'     => '$249',
                        'tachado'    => '$312',
                    ],
                    [
                        'img'        => 'images/voz-ac.png',
                        'alt'        => 'Voces Binci Originales para Acordeón',
                        'badge'      => null,
                        'badge_color'=> null,
                        'nombre'     => 'Voces Binci Originales Juego Completo',
                        'desc'       => 'Set completo de cañas para renovar tu acordeón',
                        'estrellas'  => 4.5,
                        'opiniones'  => 203,
                        'precio'     => '$399',
                        'tachado'    => null,
                    ],
                    [
                        'img'        => 'images/mochila.png',
                        'alt'        => 'Mochila de Cuero Premium',
                        'badge'      => 'Oferta',
                        'badge_color'=> 'bg-blue-500',
                        'nombre'     => 'Mochila de Cuero Premium',
                        'desc'       => 'Mochila ergonómica con soporte ajustable',
                        'estrellas'  => 5,
                        'opiniones'  => 312,
                        'precio'     => '$79',
                        'tachado'    => '$99',
                    ],
                    [
                        'img'        => 'images/estuche.png',
                        'alt'        => 'Estuche de Viaje Rígido',
                        'badge'      => null,
                        'badge_color'=> null,
                        'nombre'     => 'Estuche de Viaje Rígido',
                        'desc'       => 'Protección total para tu acordeón en viajes',
                        'estrellas'  => 4,
                        'opiniones'  => 187,
                        'precio'     => '$189',
                        'tachado'    => null,
                    ],
                    [
                        'img'        => 'images/kit-mant.png',
                        'alt'        => 'Kit Completo de Mantenimiento',
                        'badge'      => '-25%',
                        'badge_color'=> 'bg-red-500',
                        'nombre'     => 'Kit Completo de Mantenimiento',
                        'desc'       => 'Todo lo necesario para cuidar tu acordeón',
                        'estrellas'  => 4.5,
                        'opiniones'  => 298,
                        'precio'     => '$149',
                        'tachado'    => '$199',
                    ],
                    [
                        'img'        => 'images/libro.png',
                        'alt'        => 'Libro de Escalas y Técnicas',
                        'badge'      => 'Nuevo',
                        'badge_color'=> 'bg-green-500',
                        'nombre'     => 'Libro de Escalas y Técnicas',
                        'desc'       => '50 composiciones clásicas para acordeón',
                        'estrellas'  => 5,
                        'opiniones'  => 156,
                        'precio'     => '$45',
                        'tachado'    => null,
                    ],
                ];
                @endphp

                @foreach($productos as $p)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 flex flex-col">

                    {{-- IMAGEN: fondo blanco, tamaño fijo, object-contain con padding --}}
                    <div class="relative h-48 bg-gray-50 border-b border-gray-100 overflow-hidden flex items-center justify-center">
                        <img
                            src="{{ asset($p['img']) }}"
                            alt="{{ $p['alt'] }}"
                            class="h-40 w-full object-contain p-3 transition-transform duration-300 hover:scale-105"
                            onerror="this.onerror=null; this.src='https://placehold.co/300x160/fee2e2/b91c1c?text=Sin+imagen'">

                        @if($p['badge'])
                            <span class="absolute top-3 right-3 {{ $p['badge_color'] }} text-white px-3 py-1 rounded-full text-xs font-bold shadow">
                                {{ $p['badge'] }}
                            </span>
                        @endif
                    </div>

                    {{-- BODY --}}
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-sm font-bold text-gray-800 mb-1 line-clamp-2 leading-snug">
                            {{ $p['nombre'] }}
                        </h3>
                        <p class="text-gray-500 text-xs mb-3 line-clamp-2 leading-relaxed flex-1">
                            {{ $p['desc'] }}
                        </p>

                        {{-- ESTRELLAS --}}
                        <div class="flex items-center gap-1 mb-3">
                            @php
                                $llenas  = floor($p['estrellas']);
                                $media   = ($p['estrellas'] - $llenas) >= 0.5;
                            @endphp
                            @for($i = 0; $i < $llenas; $i++)
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                            @endfor
                            @if($media)
                                <i class="fas fa-star-half-alt text-yellow-400 text-xs"></i>
                            @endif
                            <span class="text-xs text-gray-400 ml-1">({{ $p['opiniones'] }})</span>
                        </div>

                        {{-- PRECIO --}}
                        <div class="flex items-baseline gap-2 mb-4">
                            <span class="text-xl font-bold text-red-700">{{ $p['precio'] }}</span>
                            @if($p['tachado'])
                                <span class="text-xs line-through text-gray-400">{{ $p['tachado'] }}</span>
                            @endif
                        </div>

                        <button class="w-full bg-red-700 hover:bg-red-800 active:scale-95 text-white py-2 rounded-lg transition font-bold text-sm flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-cart"></i> Agregar
                        </button>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- OFERTAS FLASH --}}
            <h2 class="text-3xl font-bold text-gray-800 mb-8 pb-3 border-b-4 border-red-700 flex items-center gap-3">
                <i class="fas fa-fire text-red-700"></i> Ofertas Flash
            </h2>

            <div class="bg-gradient-to-r from-red-700 to-red-900 rounded-lg shadow-2xl p-8 mb-12 text-white">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <i class="fas fa-shipping-fast text-4xl mb-3 block"></i>
                        <h3 class="font-bold text-lg mb-2">Envío Gratis</h3>
                        <p class="text-red-100">En compras mayores a $500</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-shield-alt text-4xl mb-3 block"></i>
                        <h3 class="font-bold text-lg mb-2">Garantía 2 Años</h3>
                        <p class="text-red-100">En todos nuestros productos</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-undo text-4xl mb-3 block"></i>
                        <h3 class="font-bold text-lg mb-2">Devolución Fácil</h3>
                        <p class="text-red-100">30 días sin preguntas</p>
                    </div>
                </div>
            </div>

            {{-- FAQ --}}
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h3 class="text-2xl font-bold text-red-700 mb-6 flex items-center gap-2">
                    <i class="fas fa-question-circle"></i> Preguntas Frecuentes sobre Productos
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border-l-4 border-red-700 pl-4">
                        <h4 class="font-bold text-gray-800 mb-2">¿Cómo elijo el acordeón correcto?</h4>
                        <p class="text-gray-600 text-sm">Te recomendamos contactar con nuestros expertos. Ofrecemos consultoría gratuita para ayudarte a elegir el instrumento perfecto según tu nivel.</p>
                    </div>
                    <div class="border-l-4 border-red-700 pl-4">
                        <h4 class="font-bold text-gray-800 mb-2">¿Todos los productos tienen garantía?</h4>
                        <p class="text-gray-600 text-sm">Sí, todos nuestros productos incluyen garantía de 2 años. Además ofrecemos servicio técnico post-venta.</p>
                    </div>
                    <div class="border-l-4 border-red-700 pl-4">
                        <h4 class="font-bold text-gray-800 mb-2">¿Hacen envíos internacionales?</h4>
                        <p class="text-gray-600 text-sm">Sí, realizamos envíos a todo el mundo. Contacta para cotizar el envío y los impuestos de aduana.</p>
                    </div>
                    <div class="border-l-4 border-red-700 pl-4">
                        <h4 class="font-bold text-gray-800 mb-2">¿Ofrecen planes de financiamiento?</h4>
                        <p class="text-gray-600 text-sm">Sí, contamos con planes de financiamiento sin interés en compras mayores. Consulta nuestras opciones.</p>
                    </div>
                </div>
            </div>

           
            <div class="bg-gradient-to-r from-red-600 to-red-800 rounded-lg shadow-2xl p-12 text-white text-center">
                <h2 class="text-3xl font-bold mb-4">¿No encuentras lo que buscas?</h2>
                <p class="text-red-100 text-lg mb-6">Nuestro equipo de expertos está aquí para ayudarte</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact.show') }}"
                       class="bg-white text-red-700 font-bold px-8 py-3 rounded-lg hover:bg-red-50 transition">
                        <i class="fas fa-envelope"></i> Contáctanos
                    </a>
                    <button class="bg-red-900 hover:bg-red-950 text-white font-bold px-8 py-3 rounded-lg transition border-2 border-white">
                        <i class="fas fa-comments"></i> Chat con Soporte
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>