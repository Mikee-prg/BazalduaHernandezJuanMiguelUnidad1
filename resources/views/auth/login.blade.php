<x-guest-layout :title="'Iniciar sesión'">
    <div class="w-full max-w-md">
        <h1 class="font-display text-3xl font-bold text-primary-700 mb-1">Bienvenido de vuelta</h1>
        <p class="text-gray-500 text-sm mb-8">Accede a tu cuenta AccordionZone</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">
                    Correo electrónico
                </label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2.5 border rounded-lg text-sm font-body border-primary-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition @error('email') border-red-500 @enderror"
                    placeholder="tucorreo@ejemplo.com">
                @error('email')
                    <p class="text-primary-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wider">
                        Contraseña
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-primary-600 font-bold hover:text-primary-800 transition">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
                <input id="password" name="password" type="password" required
                    class="w-full px-4 py-2.5 border rounded-lg text-sm font-body border-primary-200 bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 outline-none transition @error('password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-primary-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 accent-primary-700 rounded">
                <label for="remember_me" class="text-sm text-gray-500">Recordarme</label>
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
                Entrar
            </button>

            <p class="text-center text-xs text-gray-400">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-primary-600 font-bold hover:text-primary-800 transition">
                    Regístrate gratis
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>
