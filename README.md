# 🎵 AccordionZone - Tienda Online de Acordeones

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-blue)](https://tailwindcss.com)
[![reCAPTCHA](https://img.shields.io/badge/reCAPTCHA-v3-green)](https://www.google.com/recaptcha)
[![License](https://img.shields.io/badge/License-MIT-yellow)](LICENSE)

Una tienda en línea moderna y profesional para la venta de acordeones, refacciones y accesorios, construida con Laravel y Tailwind CSS.

## ✨ Características Principales

### 🎨 Diseño Profesional
- Paleta de colores **rojo y blanco** profesional
- Diseño **responsive** (Mobile, Tablet, Desktop)
- Componentes reutilizables de Blade
- Animaciones suaves y transiciones

### 🧭 Navegación Completa
- Menú principal con secciones y submenús
- Búsqueda de productos en el sitio
- Mapa del sitio navegable
- Enlaces a todas las secciones secundarias

### 🛍️ Secciones Principales
- **Acordeones** - Catálogo de acordeones nuevos y usados
- **Refacciones** - Componentes y repuestos
- **Accesorios** - Accesorios musicales premium
- **Reparaciones** - Servicio profesional de mantenimiento
- **Promociones** - Ofertas y descuentos especiales

### 📧 Formulario de Contacto Avanzado
- Validación en **3 niveles**: Frontend, Backend, y Humano
- **reCAPTCHA v3** integrado para detección de bots
- Detección inteligente de spam
- Mensajes de error personalizados
- Confirmación de envío

### 🔐 Seguridad Multicapa
- Validación HTML5 en el navegador
- Validación Laravel en el servidor
- reCAPTCHA v3 para verificación humana
- Protección CSRF en todos los formularios
- Detección de patrones de spam

### 📱 Responsive Design
```
✓ Desktop (1920px+)
✓ Tablet (768px - 1024px)
✓ Mobile (360px - 767px)
```

### 🎭 Páginas de Error Personalizadas
- 404 - Página no encontrada
- 403 - Acceso denegado
- 419 - Sesión expirada
- 500 - Error del servidor

## 🚀 Inicio Rápido

### Requisitos Previos
```bash
- PHP >= 8.0
- Laravel >= 10.x
- Composer
- Node.js & NPM
- MySQL (opcional)
```

### Instalación

1. **Clonar o descargar el proyecto**
```bash
cd AccordionZone
```

2. **Instalar dependencias PHP**
```bash
composer install
```

3. **Instalar dependencias Node**
```bash
npm install
```

4. **Configurar archivo .env**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Agregar claves reCAPTCHA**
   - Ve a: https://www.google.com/recaptcha/admin
   - Crea un nuevo sitio con reCAPTCHA v3
   - Copia las claves a `.env`:
   ```env
   RECAPTCHA_SITE_KEY=tu_site_key
   RECAPTCHA_SECRET_KEY=tu_secret_key
   ```

6. **Compilar assets**
```bash
npm run dev    # Desarrollo
npm run build  # Producción
```

7. **Iniciar servidor**
```bash
php artisan serve
```

Accede a: http://localhost:8000

## 📖 Documentación

### Archivos de Ayuda

| Archivo | Descripción |
|---------|-----------|
| [SETUP.md](SETUP.md) | Guía completa de instalación y configuración |
| [VALIDACION.md](VALIDACION.md) | Documentación detallada sobre validación y reCAPTCHA |
| [PERSONALIZACION.md](PERSONALIZACION.md) | Guía para personalizar colores, menús y contenido |

## 🗂️ Estructura de Carpetas

```
resources/
├── views/
│   ├── dashboard.blade.php         ← Dashboard principal
│   ├── contact.blade.php           ← Formulario de contacto
│   ├── sitemap.blade.php           ← Mapa del sitio
│   ├── auth/
│   │   └── forgot-password.blade.php
│   ├── errors/                     ← Páginas de error personalizadas
│   │   ├── 404.blade.php
│   │   ├── 403.blade.php
│   │   ├── 419.blade.php
│   │   └── 500.blade.php
│   ├── components/                 ← Componentes Blade reutilizables
│   │   ├── alert.blade.php
│   │   └── button.blade.php
│   └── layouts/
│       └── app.blade.php           ← Layout principal
│
app/Http/Controllers/
└── ContactController.php           ← Lógica de contacto con validación

routes/
└── web.php                         ← Rutas de la aplicación
```

## 🛣️ Rutas Disponibles

```
GET  /                              → Página principal
GET  /dashboard                     → Dashboard (autenticado)
GET  /contact                       → Formulario de contacto
POST /contact                       → Procesar formulario
GET  /sitemap                       → Mapa del sitio
GET  /password/forgot               → Recuperar contraseña
GET  /login                         → Iniciar sesión
GET  /register                      → Registro de usuario
```

## 🔍 Validación - Ejemplo Práctico

### Formulario de Contacto

**Frontend (HTML5 + Tailwind):**
```html
<input type="email" required>
<textarea minlength="10" maxlength="1000" required></textarea>
```

**Backend (Laravel):**
```php
$request->validate([
    'email' => 'required|email|max:100',
    'message' => 'required|string|min:10|max:1000',
    'g-recaptcha-response' => 'required',
]);
```

**Usuario Humano (reCAPTCHA v3):**
```javascript
// Se verifica automáticamente en backend
if ($recaptchaData['score'] < 0.5) {
    // Rechazar como posible bot
}
```

## 🎨 Personalización

### Cambiar Colores Principales

En `resources/views/layouts/app.blade.php`:

```css
:root {
    --primary-red: #DC2626;     /* Tu color principal */
    --dark-red: #991B1B;        /* Tu color oscuro */
    --light-red: #FEE2E2;       /* Tu color claro */
}
```

### Agregar Nueva Página

1. Crear vista en `resources/views/`
2. Agregar ruta en `routes/web.php`
3. Actualizar menú en `layouts/app.blade.php`

Ver [PERSONALIZACION.md](PERSONALIZACION.md) para más detalles.

## 📊 Stack Tecnológico

```
Frontend:
├── Tailwind CSS 3.x      - Estilos y diseño
├── Alpine.js             - Interactividad
└── Font Awesome 6.4.0    - Iconografía

Backend:
├── Laravel 10.x          - Framework
├── PHP 8.x               - Lenguaje
└── MySQL/SQLite          - Base de datos

Seguridad:
├── Google reCAPTCHA v3   - Verificación humana
├── CSRF Protection       - Protección de formularios
└── Input Validation      - Validación de datos

DevTools:
├── Vite                  - Bundler
├── NPM                   - Gestor de paquetes
├── Composer              - Gestor de dependencias
└── Laravel Artisan       - CLI
```

## 🔒 Características de Seguridad

- ✅ Validación frontend con HTML5
- ✅ Validación backend con Laravel
- ✅ reCAPTCHA v3 para detección de bots
- ✅ Detección inteligente de spam
- ✅ Protección CSRF en formularios
- ✅ Sanitización de entrada de datos
- ✅ Rate limiting (recomendado para producción)
- ✅ HTTPS obligatorio en producción

## 📋 Componentes Disponibles

### Alert
```html
<x-alert type="success" title="¡Éxito!">
    Tu mensaje fue procesado.
</x-alert>
<!-- Tipos: success, error, warning, info -->
```

### Button
```html
<x-button variant="primary" size="md" icon="fas fa-send">
    Enviar
</x-button>
<!-- Variantes: primary, secondary, danger, success -->
<!-- Tamaños: sm, md, lg -->
```

## 🧪 Testing

```bash
# Ejecutar pruebas
php artisan test

# Con cobertura
php artisan test --coverage

# Prueba específica
php artisan test tests/Feature/ContactTest.php
```

## 🐛 Solución de Problemas

### reCAPTCHA no funciona
- Verifica claves en `.env`
- Comprueba que el dominio esté registrado
- Ejecuta: `php artisan config:clear`

### Estilos Tailwind no se aplican
- Ejecuta: `npm run dev`
- Limpia cache: `php artisan view:clear`

### Formulario no valida
- Verifica consola del navegador (F12)
- Revisa logs: `storage/logs/laravel.log`

## 📈 Mejoras Futuras

- [ ] Sistema de carrito de compras
- [ ] Pasarela de pagos (Stripe/PayPal)
- [ ] Panel de administración
- [ ] Sistema de comentarios y reseñas
- [ ] Blog integrado
- [ ] Sistema de búsqueda avanzada
- [ ] Catálogo de productos dinámico
- [ ] Chat en vivo con soporte

## 📞 Soporte

- 📧 **Email:** info@accordionzone.com
- 📱 **Teléfono:** +1 (800) 123-4567
- 💬 **Chat:** Disponible en el sitio web
- 📋 **Documentación:** Ver archivos .md en el proyecto

## 📄 Licencia

Este proyecto está bajo licencia MIT. Ver archivo [LICENSE](LICENSE) para más detalles.

## 👨‍💻 Desarrollador

Desarrollado con ❤️ para AccordionZone

---

## 🎯 Quick Links

- 📖 [Guía de Instalación](SETUP.md)
- 🔐 [Validación & reCAPTCHA](VALIDACION.md)
- 🎨 [Personalización](PERSONALIZACION.md)

---

**Última actualización:** 2026-06-05  
**Versión:** 1.0.0  
**Estado:** ✅ Producción

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
