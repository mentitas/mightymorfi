# Uso imagen de Composer como base
#FROM composer:lts
FROM php:8.2.25-apache

# INSTALACIONES PAQUETES
RUN apt-get update
RUN apt-get install -y nodejs npm
RUN apt-get install -y git \
            zip \
            curl \
            sudo \
            unzip \
            libicu-dev \
            libbz2-dev \
            libpng-dev \
            libjpeg-dev \
            libmcrypt-dev \
            libreadline-dev \
            libfreetype6-dev \
            g++
RUN apt-get install -y \
      libpng-dev \
      libmagickwand-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && rm -rf /tmp/*

# Copio el codigo al container
COPY ./laravel-project/package.json  .

# Instalacion dependencias
RUN npm install

# Set the working directory (Para exponer en APACHE)
WORKDIR /var/www/html

# Copio resto codigo
COPY ./laravel-project  .

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite headers
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalacion COMPOSERRUN composer install
RUN composer install

# Populacion DB
RUN php artisan migrate --seed

# Set permissions (Para exponer en APACHE)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# BUILDEAR Y PUBLICAR APP EN SERVER PRUEBA
RUN npm run build

#CMD php artisan serve --host 0.0.0.0

#EXPOSE 8000/tcp
EXPOSE 80/tcp