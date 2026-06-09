<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-red-700">
            <i class="fas fa-sitemap"></i> Mapa del Sitio
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Introducción -->
                <div class="mb-8 p-6 bg-red-50 rounded-lg border-l-4 border-red-700">
                    <p class="text-gray-700">
                        Navega fácilmente por AccordionZone usando este mapa del sitio. Aquí encontrarás enlaces a todas las secciones principales y secundarias.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Secciones Principales -->
                    <div>
                        <h3 class="text-xl font-bold text-red-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-home"></i> Principales
                        </h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="/" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Inicio
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Acordeones
                                </a>
                                <ul class="ml-6 mt-2 space-y-2">
                                    <li><a href="#" class="text-blue-500 hover:text-red-600 text-sm flex items-center gap-2">
                                        <span>→</span> Acordeones Nuevos
                                    </a></li>
                                    <li><a href="#" class="text-blue-500 hover:text-red-600 text-sm flex items-center gap-2">
                                        <span>→</span> Acordeones Usados
                                    </a></li>
                                    <li><a href="#" class="text-blue-500 hover:text-red-600 text-sm flex items-center gap-2">
                                        <span>→</span> Por Marca
                                    </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Refacciones
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Accesorios
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Servicios -->
                    <div>
                        <h3 class="text-xl font-bold text-red-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-cogs"></i> Servicios
                        </h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Reparaciones
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Promociones
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Clases Online
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Comunidad
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Blog
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Soporte y Legal -->
                    <div>
                        <h3 class="text-xl font-bold text-red-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-headset"></i> Soporte
                        </h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('contact.show') }}" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Contáctanos
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Ayuda & FAQ
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Chat en Vivo
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Buzón de Sugerencias
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Recuperar Contraseña
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Sección Cuenta -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-xl font-bold text-red-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-user"></i> Mi Cuenta
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @auth
                            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                <i class="fas fa-arrow-right text-red-500"></i> Mi Perfil
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                    <i class="fas fa-arrow-right text-red-500"></i> Cerrar Sesión
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                <i class="fas fa-arrow-right text-red-500"></i> Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                <i class="fas fa-arrow-right text-red-500"></i> Registrarse
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Legal -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-xl font-bold text-red-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-legal"></i> Legal
                    </h3>
                    <ul class="space-y-2 grid grid-cols-1 md:grid-cols-2">
                        <li>
                            <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                <i class="fas fa-arrow-right text-red-500"></i> Términos y Condiciones
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                <i class="fas fa-arrow-right text-red-500"></i> Política de Privacidad
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                <i class="fas fa-arrow-right text-red-500"></i> Política de Devoluciones
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                <i class="fas fa-arrow-right text-red-500"></i> Política de Envíos
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:text-red-700 transition flex items-center gap-2">
                                <i class="fas fa-arrow-right text-red-500"></i> Cookies
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Info de Contacto -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-xl font-bold text-red-700 mb-4">Información de Contacto</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <div class="p-4 bg-red-50 rounded-lg">
                            <p class="text-gray-600 text-sm mb-2">📞 Teléfono</p>
                            <p class="font-bold text-red-700">+1 (800) 123-4567</p>
                        </div>
                        <div class="p-4 bg-red-50 rounded-lg">
                            <p class="text-gray-600 text-sm mb-2">📧 Email</p>
                            <p class="font-bold text-red-700">info@accordionzone.com</p>
                        </div>
                        <div class="p-4 bg-red-50 rounded-lg">
                            <p class="text-gray-600 text-sm mb-2">🕐 Horario</p>
                            <p class="font-bold text-red-700">Lun-Vie: 9am - 6pm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
