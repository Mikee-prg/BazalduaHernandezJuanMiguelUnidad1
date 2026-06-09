# 🔒 Validación en AccordionZone

## Niveles de Validación

AccordionZone implementa validación en **tres niveles** para máxima seguridad:

### 1️⃣ Validación Frontend (Cliente)

Se ejecuta en el navegador del usuario, proporcionando retroalimentación inmediata.

#### HTML5 Validation
```html
<!-- Validación nativa del navegador -->
<input type="email" required>
<input type="tel" pattern="^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$">
<textarea minlength="10" maxlength="1000" required></textarea>
```

#### Tailwind CSS Visual Feedback
```html
<!-- El campo cambia de color al detectar errores -->
<input class="@error('email') border-red-700 @enderror">
```

### 2️⃣ Validación Backend (Servidor)

Se ejecuta en el servidor Laravel, garantizando que los datos cumplen con todas las reglas.

#### Reglas de Validación Laravel
```php
$validated = $request->validate([
    'name' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[a-záéíóúñ\s]+$/i'],
    'email' => ['required', 'email', 'max:100'],
    'phone' => ['nullable', 'regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/'],
    'subject' => ['required', 'in:ventas,soporte,reparacion,sugerencia,otro'],
    'message' => ['required', 'string', 'min:10', 'max:1000'],
    'g-recaptcha-response' => 'required',
    'agree' => ['required', 'accepted'],
], [
    // Mensajes de error personalizados
    'name.required' => 'El nombre es obligatorio',
    'name.min' => 'El nombre debe tener al menos 3 caracteres',
    // ...
]);
```

#### Validaciones Incluidas:
| Campo | Reglas | Descripción |
|-------|--------|------------|
| **Nombre** | required, min:3, max:100, regex | Solo letras y espacios |
| **Email** | required, email, max:100 | Formato de correo válido |
| **Teléfono** | nullable, regex | Formato internacional (opcional) |
| **Asunto** | required, in: | Valores predefinidos |
| **Mensaje** | required, min:10, max:1000 | Entre 10 y 1000 caracteres |
| **Acuerdo** | required, accepted | Debe estar marcado |

### 3️⃣ Validación de Usuario Humano (reCAPTCHA v3)

Detecta bots y patrones automatizados sin requerir interacción del usuario.

#### Configuración reCAPTCHA v3

##### Paso 1: Obtener las Claves

1. Ve a: [Google reCAPTCHA Console](https://www.google.com/recaptcha/admin)
2. Inicia sesión con tu cuenta Google
3. Haz clic en el **botón "+"** 
4. Completa el formulario:

```
Nombre del sitio: AccordionZone
Tipo de reCAPTCHA: reCAPTCHA v3
Dominios:
  - localhost
  - 127.0.0.1
  - tu-dominio.com
  - www.tu-dominio.com
```

5. Lee y acepta los Términos de Servicio
6. Haz clic en **Crear**
7. Copia las claves:
   - **Site Key** → `RECAPTCHA_SITE_KEY`
   - **Secret Key** → `RECAPTCHA_SECRET_KEY`

##### Paso 2: Configurar en .env
```env
RECAPTCHA_SITE_KEY=6LfAYxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
RECAPTCHA_SECRET_KEY=6LfAYxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

##### Paso 3: Implementación en Blade
```html
<!-- Cargar script de reCAPTCHA (en el header) -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- Widget de reCAPTCHA en el formulario -->
<div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
```

##### Paso 4: Validación Backend
```php
// Verificar reCAPTCHA
$recaptchaResponse = Http::asForm()->post(
    'https://www.google.com/recaptcha/api/siteverify',
    [
        'secret' => env('RECAPTCHA_SECRET_KEY'),
        'response' => $request->input('g-recaptcha-response'),
    ]
);

$recaptchaData = $recaptchaResponse->json();

// Score entre 0 (bot) y 1 (humano)
if (!$recaptchaData['success'] || $recaptchaData['score'] < 0.5) {
    return back()->withErrors(['recaptcha' => 'Verificación fallida']);
}
```

## 🤖 Detección de Spam (Anti-Bot)

Se implementa detección de patrones de spam comunes:

```php
private function detectSpam($message, $email): bool
{
    // 1. Detectar URLs excesivas
    if (substr_count($message, 'http') > 2) return true;
    
    // 2. Detectar caracteres repetitivos
    if (preg_match('/(.)\1{9,}/', $message)) return true;
    
    // 3. Detectar emails falsos
    if (preg_match('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $message) 
        && substr_count($message, '@') > 2) return true;
    
    // 4. Detectar palabras clave de spam
    $spamKeywords = ['viagra', 'casino', 'lottery', 'bitcoin', ...];
    foreach ($spamKeywords as $keyword) {
        if (strpos(strtolower($message), $keyword) !== false) return true;
    }
    
    return false;
}
```

## 🛡️ Seguridad CSRF

Todos los formularios incluyen protección contra ataques CSRF:

```html
<form method="POST" action="/contact">
    @csrf <!-- Genera token CSRF automáticamente -->
    <!-- campos del formulario -->
</form>
```

## 📊 Flujo de Validación Completo

```
┌─────────────────────────────────────────┐
│ Usuario envía formulario                 │
└─────────────────────────────────────────┘
                ↓
┌─────────────────────────────────────────┐
│ 1. Validación HTML5 (Navegador)         │
│    - Campos requeridos                  │
│    - Tipos de datos                     │
│    - Patrones                           │
└─────────────────────────────────────────┘
                ↓
         ¿Pasa?  No → Mostrar error
         ↓ Sí
┌─────────────────────────────────────────┐
│ 2. reCAPTCHA (Detecta Bots)             │
│    - Análisis de comportamiento         │
│    - Score: 0 (bot) a 1 (humano)        │
└─────────────────────────────────────────┘
                ↓
         ¿Score < 0.5?  Sí → Rechazar
         ↓ No
┌─────────────────────────────────────────┐
│ 3. Validación Laravel (Servidor)        │
│    - Longitudes                         │
│    - Formatos                           │
│    - Valores permitidos                 │
└─────────────────────────────────────────┘
                ↓
         ¿Válido?  No → Retornar errores
         ↓ Sí
┌─────────────────────────────────────────┐
│ 4. Detección de Spam                    │
│    - URLs sospechosas                   │
│    - Caracteres repetitivos             │
│    - Palabras clave de spam             │
└─────────────────────────────────────────┘
                ↓
         ¿Es spam?  Sí → Rechazar
         ↓ No
┌─────────────────────────────────────────┐
│ ✓ Procesamiento exitoso                 │
│ - Guardar en base de datos              │
│ - Enviar email de confirmación          │
│ - Enviar email al soporte               │
└─────────────────────────────────────────┘
```

## 🧪 Testing de Validación

### Test de Formulario Válido
```php
$response = $this->post('/contact', [
    'name' => 'Juan García',
    'email' => 'juan@example.com',
    'phone' => '+1 (800) 123-4567',
    'subject' => 'ventas',
    'message' => 'Quisiera saber más sobre sus acordeones.',
    'g-recaptcha-response' => 'valid_token',
    'agree' => true,
]);

$response->assertRedirect()
    ->assertSessionHas('success');
```

### Test de Validación que Falla
```php
$response = $this->post('/contact', [
    'name' => '123', // Inválido: números
    'email' => 'invalid-email',
    'message' => 'Hola', // Muy corto
]);

$response->assertSessionHasErrors(['name', 'email', 'message']);
```

## 📋 Lista de Verificación de Seguridad

- ✅ reCAPTCHA v3 configurado
- ✅ Validación frontend con HTML5
- ✅ Validación backend con Laravel
- ✅ Detección de spam habilitada
- ✅ CSRF token en formularios
- ✅ Mensajes de error personalizados
- ✅ Logging de intentos fallidos (recomendado)
- ✅ Rate limiting (recomendado)
- ✅ HTTPS en producción (obligatorio)

## 🔗 Referencias

- [Google reCAPTCHA Documentation](https://developers.google.com/recaptcha/docs/v3)
- [Laravel Validation](https://laravel.com/docs/validation)
- [OWASP Web Security](https://owasp.org/www-project-top-ten/)

---

**Última actualización:** 2026-06-05
