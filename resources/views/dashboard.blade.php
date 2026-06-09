<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-red-700">AccordionZone </h1>
                <p class="text-sm text-gray-600">Tienda profesional de acordeones, refacciones y accesorios.</p>
            </div>
            @auth
                <p class="text-sm text-gray-600">Bienvenido, <span class="font-bold text-red-700">{{ Auth::user()->name }}</span></p>
            @endauth
        </div>
    </x-slot>

    <div class="bg-gray-50">
        <section class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <p class="text-sm font-extrabold uppercase tracking-wide text-red-700">ID del sitio: AZ-2026</p>
                        <h2 class="mt-3 text-4xl md:text-5xl font-extrabold text-gray-950 leading-tight">Acordeones listos para sonar, refacciones confiables y accesorios de batalla.</h2>
                        <p class="mt-5 text-lg text-gray-600">Compra instrumentos nuevos y seminuevos, pide asesoría técnica y encuentra piezas originales para mantener tu acordeón en perfecto estado.</p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('products') }}" class="inline-flex justify-center items-center gap-2 bg-red-700 hover:bg-red-800 text-white font-bold px-6 py-3 rounded">
                                <i class="fas fa-bag-shopping"></i> Ver catálogo
                            </a>
                            <a href="{{ route('contact.show') }}" class="inline-flex justify-center items-center gap-2 border-2 border-red-700 text-red-700 hover:bg-red-50 font-bold px-6 py-3 rounded">
                                <i class="fas fa-headset"></i> Asesoría
                            </a>
                        </div>
                    </div>
                    <div class="bg-red-700 text-white rounded p-8 shadow-xl">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/10 rounded p-5">
                                <i class="fas fa-music text-3xl"></i>
                                <p class="mt-4 text-3xl font-extrabold">120+</p>
                                <p class="text-red-100 text-sm">Acordeones</p>
                            </div>
                            <div class="bg-white/10 rounded p-5">
                                <i class="fas fa-screwdriver-wrench text-3xl"></i>
                                <p class="mt-4 text-3xl font-extrabold">350+</p>
                                <p class="text-red-100 text-sm">Refacciones</p>
                            </div>
                            <div class="bg-white/10 rounded p-5">
                                <i class="fas fa-shield-halved text-3xl"></i>
                                <p class="mt-4 text-3xl font-extrabold">2 años</p>
                                <p class="text-red-100 text-sm">Garantía</p>
                            </div>
                            <div class="bg-white/10 rounded p-5">
                                <i class="fas fa-truck-fast text-3xl"></i>
                                <p class="mt-4 text-3xl font-extrabold">24 h</p>
                                <p class="text-red-100 text-sm">Atención</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex items-end justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-950">Secciones principales</h2>
                    <p class="text-gray-600">Las áreas clave de venta de AccordionZone.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ([
                    ['icon' => 'fa-music', 'title' => 'Acordeones', 'text' => 'Modelos diatónicos, cromáticos, de teclas y profesionales con revisión técnica.', 'items' => ['Nuevos y seminuevos', 'Por marca y afinación', 'Garantía incluida']],
                    ['icon' => 'fa-screwdriver-wrench', 'title' => 'Refacciones', 'text' => 'Piezas para reparación, ajuste y restauración con compatibilidad revisada.', 'items' => ['Fuelles', 'voces', 'Botones y válvulas']],
                    ['icon' => 'fa-guitar', 'title' => 'Accesorios', 'text' => 'Complementos para proteger, transportar y mejorar tu experiencia musical.', 'items' => ['Correas', 'Estuches', 'Kits de mantenimiento']],
                ] as $section)
                    <article class="bg-white border border-red-100 rounded shadow-sm overflow-hidden">
                        <div class="h-2 bg-red-700"></div>
                        <div class="p-6">
                            <i class="fas {{ $section['icon'] }} text-3xl text-red-700"></i>
                            <h3 class="mt-4 text-xl font-extrabold text-gray-950">{{ $section['title'] }}</h3>
                            <p class="mt-3 text-gray-600">{{ $section['text'] }}</p>
                            <ul class="mt-5 space-y-2 text-sm text-gray-700">
                                @foreach ($section['items'] as $item)
                                    <li><i class="fas fa-check text-red-700 mr-2"></i>{{ $item }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('products') }}" class="mt-6 inline-flex items-center gap-2 text-red-700 font-bold hover:text-red-900">
                                Explorar <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="bg-white border-y border-red-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <h2 class="text-2xl font-extrabold text-gray-950 mb-6">Secciones secundarias</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ([
                        ['fa-wrench', 'Reparaciones', 'Afinación, limpieza, cambio de fuelle y diagnóstico técnico.'],
                        ['fa-tags', 'Promociones', 'Combos y descuentos por temporada para músicos y talleres.'],
                        ['fa-graduation-cap', 'Clases online', 'Acompañamiento para principiantes y músicos avanzados.'],
                        ['fa-users', 'Comunidad', 'Eventos, recomendaciones y recursos para acordeonistas.'],
                    ] as $service)
                        <div class="border-l-4 border-red-700 bg-gray-50 rounded p-5">
                            <h3 class="font-extrabold text-red-700"><i class="fas {{ $service[0] }} mr-2"></i>{{ $service[1] }}</h3>
                            <p class="mt-3 text-sm text-gray-600">{{ $service[2] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="ayuda" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                

                <div id="chat" class="bg-red-700 text-white rounded shadow-sm p-6">
                    <h2 class="text-2xl font-extrabold">Chat y ayuda</h2>
                    <p class="mt-3 text-red-100">Soporte para compras, reparaciones, envíos y compatibilidad de refacciones.</p>
                    <a href="{{ route('contact.show') }}" class="mt-6 inline-flex bg-white text-red-700 px-5 py-3 rounded font-bold hover:bg-red-50">
                        Abrir solicitud
                    </a>
                </div>
            </div>
        </section>

        <section id="buzon" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="bg-white rounded shadow-sm border border-red-100 p-6">
                <h2 class="text-2xl font-extrabold text-gray-950 mb-5">Elementos adicionales</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('register') }}" class="border border-red-100 rounded p-4 hover:bg-red-50"><i class="fas fa-user-plus text-red-700 mr-2"></i> Registrar</a>
                    <a href="{{ route('login') }}" class="border border-red-100 rounded p-4 hover:bg-red-50"><i class="fas fa-right-to-bracket text-red-700 mr-2"></i> Inicio de sesión</a>
                   
                  
                    <a href="{{ route('contact.show') }}" class="border border-red-100 rounded p-4 hover:bg-red-50"><i class="fas fa-envelope text-red-700 mr-2"></i> Contáctanos</a>
                    <a href="#ayuda" class="border border-red-100 rounded p-4 hover:bg-red-50"><i class="fas fa-circle-question text-red-700 mr-2"></i> Ayuda</a>
                    <a href="#chat" class="border border-red-100 rounded p-4 hover:bg-red-50"><i class="fas fa-comments text-red-700 mr-2"></i> Chat</a>
                    <a href="{{ route('contact.show') }}" class="border border-red-100 rounded p-4 hover:bg-red-50"><i class="fas fa-inbox text-red-700 mr-2"></i> Buzón de sugerencias</a>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
