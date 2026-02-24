FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
 && docker-php-ext-install pdo pdo_mysql \
 && docker-php-ext-enable pdo_mysql

# instalar Node 18 (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs

RUN a2enmod rewrite

WORKDIR /var/www/html

# Apuntar Apache a /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
 && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s|AllowOverride None|AllowOverride All|' /etc/apache2/apache2.conf

 RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
