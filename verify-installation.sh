#!/usr/bin/env bash

# Colores para la terminal
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}╔════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║  🎵 AccordionZone - Verificación de Instalación           ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════╝${NC}"
echo ""

# Función para verificar comando
check_command() {
    if command -v $1 &> /dev/null; then
        echo -e "${GREEN}✓${NC} $1 - $(${1} --version | head -n1)"
    else
        echo -e "${RED}✗${NC} $1 - NO ENCONTRADO"
    fi
}

# Función para verificar archivo
check_file() {
    if [ -f "$1" ]; then
        echo -e "${GREEN}✓${NC} $1"
    else
        echo -e "${RED}✗${NC} $1 - NO ENCONTRADO"
    fi
}

# Función para verificar directorio
check_dir() {
    if [ -d "$1" ]; then
        echo -e "${GREEN}✓${NC} Directorio: $1"
    else
        echo -e "${RED}✗${NC} Directorio: $1 - NO ENCONTRADO"
    fi
}

echo -e "${YELLOW}📋 Verificando Requisitos del Sistema:${NC}"
check_command "php"
check_command "npm"
check_command "composer"
check_command "node"
echo ""

echo -e "${YELLOW}📁 Verificando Archivos de Configuración:${NC}"
check_file ".env"
check_file ".env.example"
check_file "composer.json"
check_file "package.json"
check_file "vite.config.js"
check_file "tailwind.config.js"
echo ""

echo -e "${YELLOW}📂 Verificando Estructura de Carpetas:${NC}"
check_dir "app"
check_dir "resources"
check_dir "routes"
check_dir "storage"
check_dir "vendor"
check_dir "node_modules"
echo ""

echo -e "${YELLOW}🗂️ Verificando Vistas Principales:${NC}"
check_file "resources/views/dashboard.blade.php"
check_file "resources/views/contact.blade.php"
check_file "resources/views/sitemap.blade.php"
check_file "resources/views/layouts/app.blade.php"
check_file "resources/views/errors/404.blade.php"
echo ""

echo -e "${YELLOW}⚙️ Verificando Controladores:${NC}"
check_file "app/Http/Controllers/ContactController.php"
echo ""

echo -e "${YELLOW}📖 Verificando Documentación:${NC}"
check_file "README.md"
check_file "SETUP.md"
check_file "VALIDACION.md"
check_file "PERSONALIZACION.md"
echo ""

echo -e "${YELLOW}🔐 Verificando Configuración de reCAPTCHA:${NC}"
if grep -q "RECAPTCHA_SITE_KEY" .env; then
    echo -e "${GREEN}✓${NC} RECAPTCHA_SITE_KEY configurado"
else
    echo -e "${RED}✗${NC} RECAPTCHA_SITE_KEY - NO CONFIGURADO"
fi

if grep -q "RECAPTCHA_SECRET_KEY" .env; then
    echo -e "${GREEN}✓${NC} RECAPTCHA_SECRET_KEY configurado"
else
    echo -e "${RED}✗${NC} RECAPTCHA_SECRET_KEY - NO CONFIGURADO"
fi
echo ""

echo -e "${BLUE}╔════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║  📝 Próximos Pasos:                                       ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════╝${NC}"
echo ""
echo "1. Agrega tus claves de reCAPTCHA a .env:"
echo "   - RECAPTCHA_SITE_KEY=tu_site_key"
echo "   - RECAPTCHA_SECRET_KEY=tu_secret_key"
echo ""
echo "2. Compila los assets:"
echo "   npm run dev    # Desarrollo"
echo "   npm run build  # Producción"
echo ""
echo "3. Inicia el servidor:"
echo "   php artisan serve"
echo ""
echo "4. Accede a:"
echo "   http://localhost:8000"
echo ""
echo -e "${GREEN}✓ Verificación completada${NC}"
