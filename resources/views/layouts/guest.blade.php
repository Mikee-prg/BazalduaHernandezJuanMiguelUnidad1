<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccordionZone - {{ $title ?? 'Bienvenido' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    @if (config('services.recaptcha.site_key'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-cream font-body flex">
    <aside class="hidden md:flex flex-col w-64 bg-primary-700 text-white p-8 min-h-screen">
        <div>
            <h1 class="font-display text-2xl font-bold leading-tight">AccordionZone</h1>
            <p class="text-primary-200 text-xs font-light tracking-wider mt-1">Acordeones, refacciones y accesorios</p>
        </div>

        <hr class="border-white/20 my-6">

        <nav class="flex flex-col gap-3 text-sm">
            <a href="/" class="flex items-center gap-3 text-white/70 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"/></svg>
                Inicio
            </a>
            <a href="{{ route('login') }}" class="flex items-center gap-3 {{ request()->routeIs('login') ? 'text-white font-bold' : 'text-white/70 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14"/></svg>
                Iniciar sesión
            </a>
            <a href="{{ route('register') }}" class="flex items-center gap-3 {{ request()->routeIs('register') ? 'text-white font-bold' : 'text-white/70 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Registrarse
            </a>
            <a href="{{ route('contact.show') }}" class="flex items-center gap-3 text-white/70 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Ayuda
            </a>
            <a href="{{ route('contact.show') }}" class="flex items-center gap-3 text-white/70 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Contáctanos
            </a>
        </nav>

        <p class="mt-auto text-xs text-white/40">&copy; 2026 AccordionZone</p>
    </aside>

    <main class="flex-1 flex items-center justify-center p-6 bg-cream">
        {{ $slot }}
    </main>
</body>
</html>
