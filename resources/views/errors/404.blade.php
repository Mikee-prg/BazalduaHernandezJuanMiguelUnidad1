@php($status = 404)
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - AccordionZone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <main class="min-h-screen flex items-center justify-center px-4 py-12">
        <section class="max-w-xl w-full bg-white rounded shadow-lg border border-red-100 p-8 text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 mb-8">
                <span class="h-11 w-11 rounded bg-red-700 text-white flex items-center justify-center">
                    <i class="fas fa-music"></i>
                </span>
                <span class="text-2xl font-extrabold text-red-700">AccordionZone</span>
            </a>

            <p class="text-7xl font-extrabold text-red-700">{{ $status }}</p>
            <h1 class="mt-4 text-2xl font-extrabold text-gray-950">Página no encontrada</h1>
            <p class="mt-3 text-gray-600">La página que buscas no existe o ya no está disponible.</p>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                <a href="{{ url('/') }}" class="bg-red-700 hover:bg-red-800 text-white font-bold py-3 rounded">
                    <i class="fas fa-home mr-2"></i>Ir a inicio
                </a>
                <a href="{{ route('contact.show') }}" class="border-2 border-red-700 text-red-700 hover:bg-red-50 font-bold py-3 rounded">
                    <i class="fas fa-headset mr-2"></i>Pedir ayuda
                </a>
            </div>

            <div class="mt-8 bg-red-50 border-l-4 border-red-700 p-4 text-left rounded">
                <h2 class="font-bold text-red-700">Soporte AccordionZone</h2>
                <p class="mt-2 text-sm text-gray-700">Correo: info@accordionzone.com</p>
                <p class="text-sm text-gray-700">Teléfono: +1 (800) 123-4567</p>
            </div>
        </section>
    </main>
</body>
</html>
