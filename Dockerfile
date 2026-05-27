FROM php:8.3-fpm

# Instalar dependencias esenciales del sistema y el servidor web Nginx
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx

# Limpiar la caché de paquetes descargados
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP requeridas por Laravel
RUN docker-php-ext-install pdo_mysql bcmath gd

# Descargar e integrar Composer limpio de forma oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio raíz dentro de la máquina virtual
WORKDIR /var/www
COPY . /var/www

# Eliminar cualquier residuo local antes de instalar
RUN rm -rf vendor composer.lock

# Instalar los paquetes de Laravel de forma 100% limpia y fresca
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Asignar los permisos necesarios para el procesamiento de archivos de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copiar el archivo nginx.conf independiente al directorio por defecto
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 10000

# Arrancar los servicios principales en paralelo de forma limpia
CMD php-fpm -D && nginx -g 'daemon off;'