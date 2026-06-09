<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AccordionZone - {{ $title ?? 'Tienda de acordeones' }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @if (config('services.recaptcha.site_key'))
            <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const siteKey = @json(config('services.recaptcha.site_key'));

                    document.querySelectorAll('form[data-recaptcha-action]').forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            const tokenInput = form.querySelector('input[name="g-recaptcha-response"]');

                            if (!tokenInput || tokenInput.value) {
                                return;
                            }

                            event.preventDefault();

                            grecaptcha.ready(function () {
                                grecaptcha.execute(siteKey, { action: form.dataset.recaptchaAction }).then(function (token) {
                                    tokenInput.value = token;
                                    form.submit();
                                });
                            });
                        });
                    });
                });
            </script>
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
<div id="chatWidget" style="position:fixed; bottom:24px; right:24px; z-index:9999; font-family:'Lato',sans-serif;">

    <button id="chatToggle" onclick="toggleChat()"
        class="w-14 h-14 bg-red-700 hover:bg-red-800 text-white rounded-full shadow-xl flex items-center justify-center text-2xl transition-all duration-300"
        title="Chat de soporte">
        <i class="fas fa-comments" id="chatIcon"></i>
    </button>

    <div id="chatWindow"
        class="hidden bottom-16 right-0 w-80 bg-white rounded-2xl shadow-2xl overflow-hidden border border-red-100"
        style="min-height:420px; display:none; flex-direction:column;">

        {{-- Header --}}
        <div class="bg-red-700 px-4 py-3 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center text-lg flex-shrink-0">
                <i class="fas fa-music text-red-700"></i>
            </div>
            <div class="flex-1">
                <p class="text-white font-bold text-sm leading-tight">Soporte AcordeónMX</p>
                <p class="text-red-200 text-xs flex items-center gap-1">
                    <span class="w-2 h-2 bg-green-400 rounded-full inline-block"></span>
                    En línea ahora
                </p>
            </div>
            <button onclick="toggleChat()" class="text-white/70 hover:text-white text-lg leading-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- Mensajes --}}
        <div id="chatMessages"
            class="flex-1 p-3 flex flex-col gap-2 overflow-y-auto bg-red-50/30"
            style="min-height:220px; max-height:260px;">
        </div>

        {{-- Respuestas rápidas --}}
        <div id="quickReplies" class="px-3 py-2 flex flex-wrap gap-2 border-t border-red-100">
            <button onclick="quickSend('Precios')"
                class="text-xs bg-red-50 text-red-700 border border-red-200 px-3 py-1 rounded-full hover:bg-red-100 transition">
                💰 Precios
            </button>
            <button onclick="quickSend('Envíos')"
                class="text-xs bg-red-50 text-red-700 border border-red-200 px-3 py-1 rounded-full hover:bg-red-100 transition">
                🚚 Envíos
            </button>
            <button onclick="quickSend('Garantía')"
                class="text-xs bg-red-50 text-red-700 border border-red-200 px-3 py-1 rounded-full hover:bg-red-100 transition">
                🛡️ Garantía
            </button>
            <button onclick="quickSend('Refacciones')"
                class="text-xs bg-red-50 text-red-700 border border-red-200 px-3 py-1 rounded-full hover:bg-red-100 transition">
                🔧 Refacciones
            </button>
        </div>

        {{-- Input --}}
        <div class="flex gap-2 px-3 py-2 border-t border-red-100 bg-white">
            <input type="text" id="chatInput"
                placeholder="Escribe tu mensaje..."
                class="flex-1 text-sm border border-red-200 rounded-full px-3 py-2 focus:outline-none focus:border-red-500 bg-gray-50"
                onkeydown="if(event.key==='Enter') sendChatMsg()">
            <button onclick="sendChatMsg()"
                class="w-9 h-9 bg-red-700 hover:bg-red-800 text-white rounded-full flex items-center justify-center flex-shrink-0 transition">
                <i class="fas fa-paper-plane text-xs"></i>
            </button>
        </div>

    </div>
</div>

<style>
    .chat-bubble-bot {
        background: #FEE2E2;
        color: #7F1D1D;
        border-radius: 12px 12px 12px 3px;
        padding: 8px 11px;
        font-size: 13px;
        line-height: 1.5;
        max-width: 85%;
        align-self: flex-start;
    }
    .chat-bubble-user {
        background: #B91C1C;
        color: #fff;
        border-radius: 12px 12px 3px 12px;
        padding: 8px 11px;
        font-size: 13px;
        line-height: 1.5;
        max-width: 85%;
        align-self: flex-end;
    }
    .chat-time {
        font-size: 10px;
        opacity: 0.55;
        margin-top: 3px;
    }
    .typing-dots span {
        display: inline-block;
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #B91C1C;
        animation: chatBounce 1.2s infinite;
        margin: 0 2px;
    }
    .typing-dots span:nth-child(2) { animation-delay: .2s; }
    .typing-dots span:nth-child(3) { animation-delay: .4s; }
    @keyframes chatBounce {
        0%,60%,100% { transform: translateY(0); }
        30%          { transform: translateY(-5px); }
    }
</style>

<script>
(function() {

    {{-- Base de conocimiento del bot --}}
    const kb = {
        'precio':      'Nuestros acordeones van desde $45 (libros/accesorios) hasta $24,000 (profesionales). ¿Te interesa algún rango de precio en particular?',
        'envío':       '🚚 Enviamos a toda la república mexicana. Envío gratis en compras mayores a $500. Tiempo de entrega: 3 a 5 días hábiles.',
        'envio':       '🚚 Enviamos a toda la república mexicana. Envío gratis en compras mayores a $500. Tiempo de entrega: 3 a 5 días hábiles.',
        'garantía':    '🛡️ Todos nuestros productos tienen garantía de 2 años e incluyen servicio técnico post-venta sin costo adicional.',
        'garantia':    '🛡️ Todos nuestros productos tienen garantía de 2 años e incluyen servicio técnico post-venta sin costo adicional.',
        'refacción':   '🔧 Tenemos fuelles, cañas, bajos, teclados y más. ¿Para qué modelo de acordeón necesitas la refacción?',
        'refaccion':   '🔧 Tenemos fuelles, cañas, bajos, teclados y más. ¿Para qué modelo de acordeón necesitas la refacción?',
        'acordeon':    '🪗 Contamos con acordeones diatónicos de botón y de piano. ¿Buscas uno para principiante o profesional?',
        'acordeón':    '🪗 Contamos con acordeones diatónicos de botón y de piano. ¿Buscas uno para principiante o profesional?',
        'pago':        '💳 Aceptamos tarjetas de crédito/débito, transferencia bancaria y efectivo. También tenemos meses sin intereses.',
        'factura':     '🧾 Sí emitimos factura electrónica (CFDI). Al finalizar tu compra puedes solicitar tu factura ingresando tus datos fiscales.',
        'contacto':    '📞 Puedes contactarnos por correo o WhatsApp. Los datos están en la sección Contáctanos del sitio.',
        'hola':        '¡Hola! 😊 ¿En qué te puedo ayudar? Pregúntame sobre precios, envíos, garantías o cualquier producto.',
        'gracias':     '¡Con gusto! 😊 Si tienes más dudas, aquí estoy. ¡Que disfrutes tu acordeón!',
        'hohner':      'Hohner es una de las marcas más reconocidas. El modelo Panther GCF es ideal para norteño y tex-mex. ¿Quieres más info de ese modelo?',
        'gabbanelli':  'Gabbanelli es una marca premium hecha en Texas con reconocimiento mundial. Tenemos varios modelos disponibles. ¿Te interesa alguno en particular?',
    };

    function getTime() {
        return new Date().toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit' });
    }

    function addBubble(txt, who) {
        const msgs = document.getElementById('chatMessages');
        const wrap = document.createElement('div');
        wrap.style.display = 'flex';
        wrap.style.flexDirection = 'column';
        wrap.style.alignItems = who === 'user' ? 'flex-end' : 'flex-start';

        const bubble = document.createElement('div');
        bubble.className = who === 'user' ? 'chat-bubble-user' : 'chat-bubble-bot';
        bubble.innerHTML = txt;

        const time = document.createElement('div');
        time.className = 'chat-time';
        time.style.textAlign = who === 'user' ? 'right' : 'left';
        time.textContent = getTime();

        wrap.appendChild(bubble);
        wrap.appendChild(time);
        msgs.appendChild(wrap);
        msgs.scrollTop = msgs.scrollHeight;
    }

    function showTyping() {
        const msgs = document.getElementById('chatMessages');
        const wrap = document.createElement('div');
        wrap.id = 'typingIndicator';
        wrap.style.cssText = 'display:flex;flex-direction:column;align-items:flex-start';

        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble-bot';
        bubble.innerHTML = '<div class="typing-dots"><span></span><span></span><span></span></div>';

        wrap.appendChild(bubble);
        msgs.appendChild(wrap);
        msgs.scrollTop = msgs.scrollHeight;
    }

    function getReply(txt) {
        const lower = txt.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, ''); // quita acentos
        for (const key in kb) {
            const kNorm = key.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            if (lower.includes(kNorm)) return kb[key];
        }
        return '¡Gracias por tu mensaje! Para darte una atención personalizada, uno de nuestros asesores se pondrá en contacto contigo pronto. También puedes visitar nuestra sección de <strong>Contáctanos</strong>.';
    }

    window.sendChatMsg = function() {
        const input = document.getElementById('chatInput');
        const txt = input.value.trim();
        if (!txt) return;

        addBubble(txt, 'user');
        input.value = '';
        document.getElementById('quickReplies').style.display = 'none';

        showTyping();
        const delay = 800 + Math.random() * 700;
        setTimeout(() => {
            const t = document.getElementById('typingIndicator');
            if (t) t.remove();
            addBubble(getReply(txt), 'bot');
        }, delay);
    };

    window.quickSend = function(txt) {
        document.getElementById('chatInput').value = txt;
        window.sendChatMsg();
    };

    window.toggleChat = function() {
        const win = document.getElementById('chatWindow');
        const icon = document.getElementById('chatIcon');
        const open = win.style.display === 'flex';

        if (open) {
            win.style.display = 'none';
            icon.className = 'fas fa-comments';
        } else {
            win.style.display = 'flex';
            
            if (document.getElementById('chatMessages').children.length === 0) {
                setTimeout(() => {
                    addBubble('¡Hola! 👋 Soy el asistente de <strong>AcordeónMX</strong>. ¿En qué puedo ayudarte hoy?', 'bot');
                }, 300);
            }
            document.getElementById('chatInput').focus();
        }
    };

})();
</script>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div class="min-h-screen flex flex-col">
            <header class="bg-white border-b border-red-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <a href="{{ url('/') }}" class="flex items-center gap-3">
                            <span class="h-11 w-11 rounded bg-red-700 text-white flex items-center justify-center">
                                <i class="fas fa-music"></i>
                            </span>
                            <span>
                                <span class="block text-2xl font-extrabold text-red-700 leading-6">AccordionZone</span>
                                <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">ID del sitio: AZ-2026</span>
                            </span>
                        </a>

                        <form action="{{ route('products') }}" method="GET" class="flex w-full lg:max-w-xl" role="search">
                            <label for="site-search" class="sr-only">Buscar en el sitio</label>
                            <input id="site-search" name="q" type="search" value="{{ request('q') }}"
                                placeholder="Buscar acordeones, refacciones o accesorios"
                                class="min-w-0 flex-1 border-2 border-red-100 rounded-l px-4 py-3 text-sm focus:border-red-700 focus:ring-red-700">
                            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-5 rounded-r font-bold">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <div class="flex flex-wrap items-center gap-4 text-sm font-bold">
                            @guest
                                <a href="{{ route('register') }}" class="text-red-700 hover:text-red-900">Registrar</a>
                                <a href="{{ route('login') }}" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded">Inicio de sesión</a>
                            @else
                                <a href="{{ route('profile.edit') }}" class="text-red-700 hover:text-red-900">{{ Auth::user()->name }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:text-red-700">Cerrar sesión</button>
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </header>

            <nav class="bg-red-700 text-white shadow-sm sticky top-0 z-40">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-3 py-3 text-sm font-bold">
                        <a href="{{ url('/') }}" class="hover:text-red-100"><i class="fas fa-home mr-1"></i> Inicio</a>
                        <a href="{{ route('products') }}#acordeones" class="hover:text-red-100"><i class="fas fa-music mr-1"></i> Acordeones</a>
                        <a href="{{ route('products') }}#refacciones" class="hover:text-red-100"><i class="fas fa-screwdriver-wrench mr-1"></i> Refacciones</a>
                        <a href="{{ route('products') }}#accesorios" class="hover:text-red-100"><i class="fas fa-guitar mr-1"></i> Accesorios</a>
                        <a href="{{ url('/dashboard') }}#ayuda" class="hover:text-red-100"><i class="fas fa-circle-question mr-1"></i> Ayuda</a>
                        <a href="{{ route('contact.show') }}" class="hover:text-red-100"><i class="fas fa-envelope mr-1"></i> Contáctanos</a>
                        <a href="{{ route('sitemap') }}" class="hover:text-red-100"><i class="fas fa-sitemap mr-1"></i> Mapa del sitio</a>

                        <a href="{{ url('/dashboard') }}#buzon" class="hover:text-red-100"><i class="fas fa-inbox mr-1"></i> Buzón</a>
                        <a href="{{ url('/dashboard') }}#chat" class="hover:text-red-100"><i class="fas fa-comments mr-1"></i> Chat</a>
                    </div>
                </div>
            </nav>

            @isset($header)
                <header class="bg-white border-b border-red-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                {{ $slot }}
            </main>

            <footer class="bg-gray-950 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <h3 class="text-lg font-extrabold text-red-400">AccordionZone</h3>
                            <p class="mt-3 text-sm text-gray-300">Venta de acordeones, refacciones originales, accesorios y soporte técnico especializado.</p>
                        </div>
                        <div>
                            <h4 class="font-bold mb-3">Tienda</h4>
                            <a href="{{ route('products') }}#acordeones" class="block text-sm text-gray-300 hover:text-red-300 mb-2">Acordeones</a>
                            <a href="{{ route('products') }}#refacciones" class="block text-sm text-gray-300 hover:text-red-300 mb-2">Refacciones</a>
                            <a href="{{ route('products') }}#accesorios" class="block text-sm text-gray-300 hover:text-red-300">Accesorios</a>
                        </div>
                        <div>
                            <h4 class="font-bold mb-3">Soporte</h4>
                            <a href="{{ route('contact.show') }}" class="block text-sm text-gray-300 hover:text-red-300 mb-2">Contáctanos</a>
                            <a href="{{ url('/dashboard') }}#ayuda" class="block text-sm text-gray-300 hover:text-red-300 mb-2">Ayuda</a>
                            <a href="{{ route('sitemap') }}" class="block text-sm text-gray-300 hover:text-red-300">Mapa del sitio</a>
                        </div>
                        <div>
                            <h4 class="font-bold mb-3">Contacto</h4>
                            <p class="text-sm text-gray-300 mb-2"><i class="fas fa-phone text-red-400 mr-2"></i> +1 (800) 123-4567</p>
                            <p class="text-sm text-gray-300"><i class="fas fa-envelope text-red-400 mr-2"></i> info@accordionzone.com</p>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-800 text-center text-sm text-gray-400">
                        &copy; 2026 AccordionZone. Todos los derechos reservados.
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
