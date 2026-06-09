<x-guest-layout :title="'Crear cuenta'">
    <div class="w-full max-w-md">
        <h1 class="font-display text-3xl font-bold text-primary-700 mb-1">Crea tu cuenta</h1>
        <p class="text-gray-500 text-sm mb-8">Únete a la comunidad AccordionZone</p>

        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
            @csrf

            <div>
                <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Nombre</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="w-full px-4 py-2.5 border border-primary-200 bg-white rounded-lg text-sm outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition @error('name') border-red-500 @enderror"
                    placeholder="nombre">
                @error('name')
                    <p class="text-primary-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2.5 border border-primary-200 bg-white rounded-lg text-sm outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition @error('email') border-red-500 @enderror"
                    placeholder="tucorreo@ejemplo.com">
                @error('email')
                    <p class="text-primary-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Contraseña</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-4 py-2.5 border border-primary-200 bg-white rounded-lg text-sm outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition @error('password') border-red-500 @enderror"
                    placeholder="Mínimo 8 caracteres">
                @error('password')
                    <p class="text-primary-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full px-4 py-2.5 border border-primary-200 bg-white rounded-lg text-sm outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition"
                    placeholder="Repite tu contraseña">
            </div>

            <div class="bg-white rounded-lg border border-primary-100 p-3">
                @if (config('services.recaptcha.site_key'))
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                @else
                    <p class="text-xs text-primary-600 font-bold">Configura RECAPTCHA_SITE_KEY para activar la verificación humana.</p>
                @endif
                @error('g-recaptcha-response')
                    <p class="text-primary-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-3 bg-primary-700 hover:bg-primary-800 text-white text-sm font-bold rounded-lg tracking-wide transition">
                Crear mi cuenta
            </button>

            <p class="text-center text-xs text-gray-400">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-primary-600 font-bold hover:text-primary-800 transition">
                    Inicia sesión
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>
