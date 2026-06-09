# 🎵 AccordionZone - Configuración e Instalación

## Descripción
AccordionZone es una tienda en línea profesional para la venta de acordeones, refacciones y accesorios, construida con Laravel y Tailwind CSS.

## ✨ Características Implementadas

### 1. **Diseño Profesional**
- Paleta de colores: Rojo (#DC2626) y Blanco
- Diseño responsivo y moderno
- Iconografía con Font Awesome

### 2. **Menú de Navegación Completo**
- **Secciones Principales:**
  - Inicio
  - Acordeones (con dropdown)
  - Refacciones
  - Accesorios
  
- **Elementos Adicionales:**
  - Reparaciones
  - Promociones
  - Ayuda & Soporte
  - Contacto
  - Mapa del Sitio
  - Recuperación de Contraseña
  - Buzón de Sugerencias
  - Chat en Vivo
  - Búsqueda en el sitio

### 3. **Dashboard Mejorado**
- Banner promocional
- Categorías principales (Acordeones, Refacciones, Accesorios)
- Servicios especiales (Reparaciones, Promociones, Clases, Comunidad)
- Estadísticas y razones para elegir AccordionZone
- Newsletter signup

### 4. **Validación de Datos**
#### Frontend:
- Validación HTML5 con atributos `required`, `type`, `pattern`
- Validación en tiempo real con Tailwind CSS

#### Backend:
- Validación Laravel con `validate()` method
- Reglas personalizadas:
  - Nombres solo con letras y espacios
  - Correos válidos
  - Teléfonos con formato internacional
  - Asuntos desde lista predefinida
  - Mensajes entre 10 y 1000 caracteres

#### Usuarios Humanos:
- **reCAPTCHA v3** para detección de bots
- Detección de spam personalizada:
  - URLs excesivas
  - Caracteres repetitivos
  - Patrones de spam comunes
  - Palabras clave sospechosas

### 5. **Páginas de Error**
- 404 (Página no encontrada)
- 403 (Acceso denegado)
- 419 (Sesión expirada)
- 500 (Error del servidor)
- Todas con diseño profesional y opciones de ayuda

### 6. **Formulario de Contacto**
- Campos: Nombre, Email, Teléfono, Asunto, Mensaje
- Validación completa frontend + backend
- reCAPTCHA integrado
- Términos y condiciones
- Visualización de errores elegante

### 7. **Página de Recuperación de Contraseña**
- Diseño profesional con colores AccordionZone
- Validación de email
- Enlaces a soporte

## 📋 Requisitos Previos

```bash
- PHP >= 8.0
- Laravel >= 10.x
- Composer
- Node.js & NPM
- Una cuenta en Google reCAPTCHA (https://www.google.com/recaptcha/admin)
```

## 🔧 Instalación

### 1. Configurar reCAPTCHA

1. Ve a: https://www.google.com/recaptcha/admin
2. Inicia sesión con tu cuenta Google
3. Haz clic en **"+"** para crear un nuevo sitio
4. Completa los datos:
   - **Nombre del sitio:** AccordionZone
   - **Tipo de reCAPTCHA:** reCAPTCHA v3
   - **Dominios:** localhost, tu-dominio.com
5. Acepta los términos y crea el sitio
6. Copia las claves proporcionadas

### 2. Configurar Variables de Entorno

Edita el archivo `.env` en la raíz del proyecto:

```env
# reCAPTCHA
RECAPTCHA_SITE_KEY=TU_SITE_KEY_AQUI
RECAPTCHA_SECRET_KEY=TU_SECRET_KEY_AQUI

# Email (para envío de mensajes de contacto)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu_usuario
MAIL_PASSWORD=tu_contraseña
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@accordionzone.com
MAIL_FROM_NAME="AccordionZone"
```

### 3. Instalar Dependencias

```bash
# Instalar dependencias PHP
composer install

# Instalar dependencias Node
npm install
```

### 4. Compilar Assets

```bash
# Desarrollo
npm run dev

# Producción
npm run build
```

### 5. Configurar Base de Datos (Opcional)

```bash
php artisan migrate
php artisan db:seed
```

## 🚀 Uso

### Desarrollar Localmente

```bash
# Terminal 1: Iniciar servidor Laravel
php artisan serve

# Terminal 2: Compilar assets en tiempo real
npm run dev
```

Accede a: http://localhost:8000

### Rutas Disponibles

```
GET  /                    → Página de bienvenida
GET  /dashboard           → Dashboard (requiere autenticación)
GET  /contact             → Formulario de contacto
POST /contact             → Procesar formulario de contacto
GET  /password/forgot     → Recuperación de contraseña
POST /password/email      → Enviar enlace de recuperación
```

## 📁 Estructura de Archivos

```
resources/views/
├── dashboard.blade.php          ← Dashboard principal
├── contact.blade.php             ← Formulario de contacto
├── auth/
│   └── forgot-password.blade.php ← Recuperación de contraseña
├── errors/
│   ├── 404.blade.php
│   ├── 403.blade.php
│   ├── 419.blade.php
│   └── 500.blade.php
└── layouts/
    └── app.blade.php             ← Layout principal con menú

app/Http/Controllers/
└── ContactController.php         ← Lógica de contacto y validación
```

## 🎨 Personalizaciones

### Cambiar Colores

Edita `resources/views/layouts/app.blade.php`:

```css
:root {
    --primary-red: #DC2626;      /* Color rojo principal */
    --dark-red: #991B1B;          /* Rojo oscuro */
    --light-red: #FEE2E2;         /* Rojo claro */
}
```

### Modificar Menú

En `resources/views/layouts/app.blade.php`, sección "Navigation Menu".

### Agregar Nuevas Categorías

1. Edita el formulario de contacto en `resources/views/contact.blade.php`
2. Agrega opciones en el campo `subject`
3. Actualiza las validaciones en `ContactController.php`

## 🔐 Seguridad

### Validación reCAPTCHA

```php
// Backend: Se valida en ContactController.php
if (!$recaptchaData['success'] || $recaptchaData['score'] < 0.5) {
    // Rechazar solicitud
}
```

### Detección de Spam

El controlador incluye:
- Validación de URLs excesivas
- Detección de caracteres repetitivos
- Análisis de palabras clave sospechosas
- Validación de email duplicados

### CSRF Protection

Todos los formularios incluyen `@csrf` automáticamente.

## 📧 Envío de Emails

Para habilitar el envío de correos de contacto:

1. Configura tu servidor SMTP en `.env`
2. Descomenta las líneas de `Mail::send()` en `ContactController.php`
3. Crea las vistas de email en `resources/views/emails/`

## 🧪 Testing

```bash
# Ejecutar pruebas
php artisan test

# Con cobertura de código
php artisan test --coverage
```

## 📱 Responsive Design

- ✓ Desktop (1920px+)
- ✓ Tablet (768px - 1024px)
- ✓ Mobile (360px - 767px)

## 🐛 Solución de Problemas

### "reCAPTCHA no funciona"
- Verifica que `RECAPTCHA_SITE_KEY` y `RECAPTCHA_SECRET_KEY` estén correctos en `.env`
- Asegúrate de que el dominio esté registrado en Google reCAPTCHA
- Limpia el cache: `php artisan config:clear`

### "Formulario no valida"
- Verifica los mensajes de error en la consola del navegador (F12)
- Revisa los logs en `storage/logs/laravel.log`
- Comprueba que la validación en backend coincida con frontend

### "Estilos Tailwind no se aplican"
- Ejecuta: `npm run dev` o `npm run build`
- Limpia cache: `php artisan view:clear`
- Verifica que `@vite` esté en el layout principal

## 📞 Soporte y Contacto

Para preguntas o sugerencias sobre AccordionZone:

- 📧 Email: info@accordionzone.com
- 📱 Teléfono: +1 (800) 123-4567
- 💬 Chat en vivo: Disponible en el sitio web

## 📄 Licencia

Este proyecto está bajo licencia MIT. Ver `LICENSE` para más detalles.

---

**Última actualización:** 2026-06-05
**Versión:** 1.0.0
