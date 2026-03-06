FROM php:8.4-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
 && docker-php-ext-install pdo pdo_mysql zip mbstring bcmath gd

# Instalar Node 20 (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html

# PHP-FPM corre por defecto en el puerto 9000
EXPOSE 9000

CMD ["php-fpm"]
