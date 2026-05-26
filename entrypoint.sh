#!/bin/sh
set -e

# Esperar a que las dependencias estén listas (opcional pero recomendado)
echo "🚀 Iniciando el contenedor de Laravel..."

# Instalar dependencias si la carpeta vendor no existe (útil en desarrollo)
if [ ! -d "vendor" ]; then
    echo "📦 Instalando dependencias de Composer..."
    composer install --no-interaction --optimize-autoloader
fi

# Optimizar la configuración y rutas de Laravel
echo "🧹 Limpiando y optimizando cachés..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar las migraciones de la base de datos de forma segura
echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force

# Ejecutar el comando principal del Dockerfile (php-fpm)
echo "🏁 Iniciando PHP-FPM..."
exec "$@"
