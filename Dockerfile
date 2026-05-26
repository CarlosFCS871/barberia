FROM php:8.3-fpm

# Instalar dependencias esenciales del sistema y el servidor web Nginx
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx

# Limpiar la caché de paquetes descargados
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP que Laravel exige para funcionar
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Descargar e integrar Composer limpio de forma oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio raíz dentro de la máquina virtual
WORKDIR /var/www
COPY . /var/www

# Instalar los paquetes de Laravel ignorando bloqueos estrictos de la plataforma
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Asignar los permisos necesarios para el procesamiento de archivos de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copiar el archivo nginx.conf independiente al directorio por defecto
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 10000

# Lanzar los procesos del motor PHP y el servidor web Nginx en paralelo
CMD php-fpm -D && nginx -g 'daemon off;'
