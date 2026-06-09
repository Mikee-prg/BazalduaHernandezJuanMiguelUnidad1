<x-guest-layout>
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-700 to-red-800 p-6 text-white">
                <h1 class="text-3xl font-bold flex items-center gap-2">
                     AccordionZone
                </h1>
                <p class="text-red-100 mt-2">Recupera tu Contraseña</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                @if (session('status'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-600 p-4 rounded">
        <p class="text-green-700 font-semibold">
            <i class="fas fa-check-circle"></i>
            Se ha enviado un enlace de recuperación a tu correo electrónico.
        </p>
    </div>
@endif

                <p class="text-gray-600 mb-6 text-sm">
                    Ingresa tu correo electrónico y te enviaremos un enlace para recuperar tu contraseña.
                </p>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-envelope text-red-700"></i> Correo Electrónico
                        </label>
                        <input id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="tu@email.com"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-700 transition @error('email') border-red-700 @enderror"
                            required 
                            autofocus>
                        @error('email')
                            <p class="text-red-700 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-red-700 hover:bg-red-800 text-white font-bold py-2 rounded-lg transition mt-6">
                        <i class="fas fa-paper-plane"></i> Enviar Enlace de Recuperación
                    </button>
                </form>

                <!-- Help Section -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <p class="text-gray-600 text-sm text-center">
                        ¿Recuerdas tu contraseña? 
                        <a href="{{ route('login') }}" class="text-red-700 font-semibold hover:underline">
                            Inicia sesión
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Support Info -->
        <div class="mt-6 bg-white rounded-lg shadow p-4 text-center">
            <p class="text-gray-600 text-sm mb-2">¿Aún tienes problemas?</p>
            <a href="#" class="text-red-700 font-semibold hover:underline">
                <i class="fas fa-headset"></i> Contacta con soporte
            </a>
        </div>
    </div>
</x-guest-layout>
