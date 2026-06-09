{{-- WIDGET DE CHAT - Flota en todas las páginas --}}
<div id="chatWidget" style="position:fixed; bottom:24px; right:24px; z-index:9999; font-family:'Lato',sans-serif;">

    {{-- Botón flotante --}}
    <button id="chatToggle" onclick="toggleChat()"
        class="w-14 h-14 bg-red-700 hover:bg-red-800 text-white rounded-full shadow-xl flex items-center justify-center text-2xl transition-all duration-300"
        title="Chat de soporte">
        <i class="fas fa-comments" id="chatIcon"></i>
    </button>

    {{-- Ventana del chat (oculta por defecto) --}}
    <div id="chatWindow"
        class="hidden absolute bottom-16 right-0 w-80 bg-white rounded-2xl shadow-2xl overflow-hidden border border-red-100"
        style="min-height:420px; display:none; flex-direction:column;">

        {{-- Header --}}
        <div class="bg-red-700 px-4 py-3 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center text-lg flex-shrink-0">
                🪗
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
            icon.className = 'fas fa-times';
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