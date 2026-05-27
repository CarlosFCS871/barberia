FROM php:8.3-fpm

# Instalar dependencias esenciales del sistema, Nginx y Node.js para Vite
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && curl -fsSL https://nodesource.com | bash - \
    && apt-get install -y nodejs

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
RUN rm -rf vendor composer.lock node_modules

# Instalar paquetes de PHP e ignorar restricciones de plataforma
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Instalar paquetes de Node y compilar la interfaz visual de Vite
RUN npm install && npm run build

# Asignar los permisos necesarios para el procesamiento de archivos de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copiar el archivo nginx.conf independiente al directorio por defecto
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 10000

# Arrancar los servicios principales en paralelo de forma limpia
CMD php-fpm -D && nginx -g 'daemon off;'