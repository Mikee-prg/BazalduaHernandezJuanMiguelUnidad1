<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Error del Servidor - AccordionZone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="text-center mb-8">
            <div class="text-red-700 font-bold text-2xl mb-4">🎵 AccordionZone</div>
        </div>
        <div class="max-w-lg w-full bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="text-6xl font-bold text-red-700 mb-4">500</div>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                <i class="fas fa-exclamation-triangle text-red-700"></i> Error del Servidor
            </h1>
            <p class="text-gray-600 mb-6">Algo salió mal en nuestro lado. Nuestro equipo ya ha sido notificado y está trabajando en ello.</p>
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <a href="/" class="flex-1 bg-red-700 hover:bg-red-800 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-home"></i> Ir a Inicio
                </a>
                <a href="javascript:history.back()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 rounded-lg transition">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
            </div>
            <div class="bg-red-50 border-l-4 border-red-700 p-4 rounded text-left">
                <h3 class="font-bold text-red-700 mb-2">¿Necesitas Ayuda?</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>📧 <a href="mailto:info@accordionzone.com" class="text-red-700 hover:underline">info@accordionzone.com</a></li>
                    <li>📞 <a href="tel:+18001234567" class="text-red-700 hover:underline">+1 (800) 123-4567</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-12 text-center text-gray-600 text-sm">
            <p>&copy; 2026 AccordionZone. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
