<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Sesión Expirada - AccordionZone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="text-center mb-8">
            <div class="text-red-700 font-bold text-2xl mb-4">🎵 AccordionZone</div>
        </div>
        <div class="max-w-lg w-full bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="text-6xl font-bold text-red-700 mb-4">419</div>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                <i class="fas fa-clock text-red-700"></i> Sesión Expirada
            </h1>
            <p class="text-gray-600 mb-6">Tu sesión ha expirado por inactividad. Por favor, inicia sesión nuevamente para continuar.</p>
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <a href="{{ route('login') }}" class="flex-1 bg-red-700 hover:bg-red-800 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </a>
                <a href="/" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 rounded-lg transition">
                    <i class="fas fa-home"></i> Ir a Inicio
                </a>
            </div>
        </div>
        <div class="mt-12 text-center text-gray-600 text-sm">
            <p>&copy; 2026 AccordionZone. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
