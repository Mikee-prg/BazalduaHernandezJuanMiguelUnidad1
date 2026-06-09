# 🎨 Guía de Personalización - AccordionZone

## Personalizaciones Comunes

### 1. Cambiar Colores del Sitio

Los colores principales se definen en `resources/views/layouts/app.blade.php`:

```css
:root {
    --primary-red: #DC2626;      /* Color rojo principal */
    --dark-red: #991B1B;          /* Rojo oscuro */
    --light-red: #FEE2E2;         /* Rojo claro */
}
```

Para cambiar a otros colores, actualiza estos valores. Por ejemplo, para azul:

```css
:root {
    --primary-blue: #2563EB;
    --dark-blue: #1e40af;
    --light-blue: #EFF6FF;
}
```

Luego reemplaza todas las instancias de `red-700`, `red-800`, etc. con `blue-700`, `blue-800`.

### 2. Modificar el Menú de Navegación

El menú está en `resources/views/layouts/app.blade.php`, sección "Navigation Menu".

#### Agregar una nueva opción principal:

```html
<a href="#" class="hover:text-red-100 transition flex items-center gap-1">
    <i class="fas fa-icon-name"></i> Nueva Opción
</a>
```

#### Agregar un submenu:

```html
<div class="relative group">
    <button class="hover:text-red-100 transition flex items-center gap-1">
        <i class="fas fa-icon-name"></i> Menú
        <i class="fas fa-chevron-down text-xs"></i>
    </button>
    <div class="absolute left-0 mt-0 w-48 bg-white text-gray-800 rounded-lg shadow-lg hidden group-hover:block">
        <a href="#" class="block px-4 py-2 hover:bg-red-50">Opción 1</a>
        <a href="#" class="block px-4 py-2 hover:bg-red-50">Opción 2</a>
    </div>
</div>
```

### 3. Agregar una Nueva Página

#### Paso 1: Crear la vista
```bash
# Crear en resources/views/pages/mi-pagina.blade.php
```

```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-red-700">
            <i class="fas fa-icon"></i> Mi Página
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido aquí -->
        </div>
    </div>
</x-app-layout>
```

#### Paso 2: Crear la ruta
En `routes/web.php`:

```php
Route::get('/mi-pagina', function () {
    return view('pages.mi-pagina');
})->name('mi-pagina');
```

#### Paso 3: Agregar enlace al menú
En `resources/views/layouts/app.blade.php`:

```html
<a href="{{ route('mi-pagina') }}" class="hover:text-red-100 transition">
    <i class="fas fa-icon"></i> Mi Página
</a>
```

### 4. Personalizar el Dashboard

Edita `resources/views/dashboard.blade.php`:

```html
<!-- Cambiar el título -->
<h3 class="text-2xl font-bold text-gray-800 mb-6">
    <i class="fas fa-new-icon"></i> Mi Sección
</h3>

<!-- Agregar nuevas tarjetas -->
<div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
    <h4 class="text-xl font-bold text-red-700 mb-2">Título</h4>
    <p class="text-gray-600">Descripción</p>
    <button class="w-full bg-red-700 hover:bg-red-800 text-white py-2 rounded-lg mt-4">
        Botón
    </button>
</div>
```

### 5. Agregar Nuevos Campos al Formulario de Contacto

#### En la vista (`resources/views/contact.blade.php`):

```html
<div>
    <label class="block text-gray-700 font-semibold mb-2">
        <i class="fas fa-icon text-red-700"></i> Mi Campo
    </label>
    <input type="text" 
        name="mi_campo" 
        placeholder="Ingresa algo"
        class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-700 @error('mi_campo') border-red-700 @enderror">
    @error('mi_campo')
        <p class="text-red-700 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
```

#### En el controlador (`app/Http/Controllers/ContactController.php`):

```php
$validated = $request->validate([
    'mi_campo' => ['required', 'string', 'max:100'],
], [
    'mi_campo.required' => 'Este campo es obligatorio',
    'mi_campo.max' => 'Máximo 100 caracteres',
]);
```

### 6. Cambiar Logos e Imágenes

#### Logo del Header
En `resources/views/layouts/app.blade.php`:

```html
<!-- Cambiar este contenido -->
<div class="flex items-center gap-2">
    <img src="/logo.png" alt="Logo" class="h-8">
    <span class="text-red-700 font-bold text-2xl">AccordionZone</span>
</div>
```

### 7. Agregar Nuevo Componente Blade

#### Crear componente en `resources/views/components/micomponente.blade.php`:

```html
@props([
    'titulo' => 'Por defecto',
    'color' => 'red',
])

<div class="p-4 rounded-lg border-l-4 border-{{ $color }}-700">
    <h3 class="font-bold text-{{ $color }}-700">{{ $titulo }}</h3>
    {{ $slot }}
</div>
```

#### Usar el componente en otra vista:

```html
<x-micomponente titulo="Hola" color="blue">
    Contenido del componente
</x-micomponente>
```

### 8. Personalizar Pie de Página

En `resources/views/layouts/app.blade.php`, sección "Footer":

```html
<!-- Modificar textos, enlaces, redes sociales, etc. -->
<footer class="bg-gray-900 text-white mt-12">
    <!-- Personaliza aquí -->
</footer>
```

### 9. Agregar Estilos Personalizados

En `resources/css/app.css`:

```css
/* Tus estilos personalizados */
.accordion-card {
    @apply bg-white rounded-lg shadow hover:shadow-lg transition;
}

.accent-text {
    @apply text-red-700 font-bold;
}
```

### 10. Agregar Funcionalidad JavaScript

En `resources/js/app.js`:

```javascript
// Código JavaScript personalizado
document.addEventListener('DOMContentLoaded', function() {
    // Tu código aquí
    console.log('Página cargada');
});
```

## 📦 Componentes Predefinidos

### Alert (Alerta)
```html
<x-alert type="success" title="¡Éxito!">
    Tu mensaje fue enviado correctamente.
</x-alert>

<!-- Tipos: success, error, warning, info -->
```

### Button (Botón)
```html
<x-button variant="primary" size="md" icon="fas fa-send">
    Enviar
</x-button>

<!-- Variantes: primary, secondary, danger, success -->
<!-- Tamaños: sm, md, lg -->
```

## 🎯 Tareas de Personalización Recomendadas

1. **Cambiar nombre del sitio:**
   - Edita `APP_NAME` en `.env`
   - Actualiza en layouts y componentes

2. **Agregar información de negocio:**
   - Actualiza teléfono, email en footer
   - Modifica direcciones de redes sociales

3. **Agregar categorías de productos:**
   - Crea nuevas vistas en `resources/views/products/`
   - Agrega rutas en `routes/web.php`
   - Actualiza menú de navegación

4. **Personalizar formularios:**
   - Agrega campos específicos de tu negocio
   - Actualiza validaciones
   - Modifica mensajes de error

5. **Crear secciones especiales:**
   - Blog
   - Galería de productos
   - Testimonios
   - FAQ

## 🚀 Tips de Rendimiento

- Optimiza imágenes antes de subirlas
- Usa `npm run build` en producción
- Activa caché de vistas: `php artisan config:cache`
- Implementa lazy loading en imágenes

## 🔗 Recursos Útiles

- [Tailwind CSS Docs](https://tailwindcss.com)
- [Laravel Blade Docs](https://laravel.com/docs/blade)
- [Font Awesome Icons](https://fontawesome.com)
- [Laravel Livewire](https://livewire.laravel.com) (para interactividad)

---

**Última actualización:** 2026-06-05
