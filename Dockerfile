FROM php:8.3-fpm

# Instalar dependencias del sistema y Node.js para Vite
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && curl -fsSL https://nodesource.com | bash - \
    && apt-get install -y nodejs

# Limpiar caché de paquetes
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP requeridas por Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Descargar la última versión limpia de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www
COPY . /var/www

# Instalar paquetes de PHP ignorando restricciones estrictas y compilar activos
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
RUN npm install && npm run build

# Asignar permisos correctos a las carpetas internas de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copiar la configuración limpia de Nginx al contenedor
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 10000

# Arrancar el procesador PHP y el servidor web Nginx en paralelo
CMD php-fpm -D && nginx -g 'daemon off;'
