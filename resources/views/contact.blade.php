<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-extrabold text-red-700">Contáctanos</h1>
            <p class="text-sm text-gray-600 mt-1">Ventas, soporte técnico, reparaciones y buzón de sugerencias.</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded shadow-sm border-t-4 border-red-700 p-6">
                    <h2 class="font-extrabold text-red-700"><i class="fas fa-phone mr-2"></i>Teléfono</h2>
                    <p class="mt-3 text-gray-700">+1 (800) 123-4567</p>
                    <p class="text-sm text-gray-500">Lun-Vie: 9am - 6pm</p>
                </div>
                <div class="bg-white rounded shadow-sm border-t-4 border-red-700 p-6">
                    <h2 class="font-extrabold text-red-700"><i class="fas fa-envelope mr-2"></i>Email</h2>
                    <p class="mt-3 text-gray-700">info@accordionzone.com</p>
                    <p class="text-sm text-gray-500">Respuesta en 24 horas</p>
                </div>
                <div class="bg-white rounded shadow-sm border-t-4 border-red-700 p-6">
                    <h2 class="font-extrabold text-red-700"><i class="fas fa-comments mr-2"></i>Chat</h2>
                    <p class="mt-3 text-gray-700">Soporte de compra y taller.</p>
                    <a href="{{ url('/dashboard') }}#chat" class="mt-3 inline-flex text-sm font-bold text-red-700 hover:text-red-900">Ir al chat</a>
                </div>
            </div>

            <div class="bg-white rounded shadow-sm border border-red-100 p-6 md:p-8">
                <h2 class="text-2xl font-extrabold text-gray-950 mb-2">Formulario de contacto</h2>
                <p class="text-sm text-gray-600 mb-6">Tus datos se validan en frontend, backend y con verificación humana reCAPTCHA.</p>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-700 p-4 rounded">
                        <h3 class="font-bold text-red-700 mb-2">Revisa estos campos:</h3>
                        <ul class="text-red-700 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-600 p-4 rounded">
                        <p class="text-green-700 font-bold">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5" novalidate>
                    @csrf
                    <input type="text" name="website" value="" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nombre completo</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" minlength="3" maxlength="100"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" required placeholder="Tu nombre"
                                class="w-full border-2 rounded px-4 py-3 focus:border-red-700 focus:ring-red-700 @error('name') border-red-700 @else border-gray-200 @enderror">
                            @error('name')<p class="text-sm text-red-700 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Correo electrónico</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" maxlength="100" required placeholder="tu@email.com"
                                class="w-full border-2 rounded px-4 py-3 focus:border-red-700 focus:ring-red-700 @error('email') border-red-700 @else border-gray-200 @enderror">
                            @error('email')<p class="text-sm text-red-700 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block text-sm font-bold text-gray-700 mb-1">Teléfono opcional</label>
                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" maxlength="20" placeholder="+1 (800) 123-4567"
                                class="w-full border-2 rounded px-4 py-3 focus:border-red-700 focus:ring-red-700 @error('phone') border-red-700 @else border-gray-200 @enderror">
                            @error('phone')<p class="text-sm text-red-700 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-bold text-gray-700 mb-1">Asunto</label>
                            <select id="subject" name="subject" required
                                class="w-full border-2 rounded px-4 py-3 focus:border-red-700 focus:ring-red-700 @error('subject') border-red-700 @else border-gray-200 @enderror">
                                <option value="">Selecciona un asunto</option>
                                <option value="ventas" @selected(old('subject') === 'ventas')>Consulta de ventas</option>
                                <option value="soporte" @selected(old('subject') === 'soporte')>Soporte técnico</option>
                                <option value="reparacion" @selected(old('subject') === 'reparacion')>Servicio de reparación</option>
                                <option value="sugerencia" @selected(old('subject') === 'sugerencia')>Buzón de sugerencias</option>
                                <option value="otro" @selected(old('subject') === 'otro')>Otro</option>
                            </select>
                            @error('subject')<p class="text-sm text-red-700 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-bold text-gray-700 mb-1">Mensaje</label>
                        <textarea id="message" name="message" rows="6" minlength="10" maxlength="1000" required
                            placeholder="Cuéntanos cómo podemos ayudarte"
                            class="w-full border-2 rounded px-4 py-3 focus:border-red-700 focus:ring-red-700 @error('message') border-red-700 @else border-gray-200 @enderror">{{ old('message') }}</textarea>
                        @error('message')<p class="text-sm text-red-700 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded p-4">
                        @if (config('services.recaptcha.site_key'))
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        @else
                            <p class="text-sm text-red-700 font-bold">Configura RECAPTCHA_SITE_KEY para mostrar la verificación humana.</p>
                        @endif
                        @error('g-recaptcha-response')<p class="text-sm text-red-700 mt-2">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-start gap-3">
                        <input id="agree" type="checkbox" name="agree" value="1" required @checked(old('agree'))
                            class="mt-1 h-4 w-4 text-red-700 border-gray-300 rounded focus:ring-red-700">
                        <label for="agree" class="text-sm text-gray-700">Acepto la política de privacidad y los términos de servicio de AccordionZone.</label>
                    </div>

                    <button type="submit" class="w-full bg-red-700 hover:bg-red-800 text-white font-extrabold py-3 rounded">
                        <i class="fas fa-paper-plane mr-2"></i>Enviar mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
