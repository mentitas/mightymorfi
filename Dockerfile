# Uso imagen de Composer como base
FROM composer:lts

# INSTALACIONES PAQUETES
RUN apk add --update nodejs npm zlib
RUN apk add --no-cache \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*
# Set the working directory (Para exponer en APACHE)
WORKDIR /var/www/html

# Copio el codigo al container
COPY ./laravel-project/package.json  .

# Instalacion dependencias
RUN npm install

# Copio resto codigo
COPY ./laravel-project  .

# Instalacion COMPOSERRUN composer install
RUN composer install

# Populacion DB
RUN php artisan migrate --seed

# Set permissions (Para exponer en APACHE)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# BUILDEAR Y PUBLICAR APP EN SERVER PRUEBA
RUN npm run build

CMD php artisan serve --host 0.0.0.0

EXPOSE 8000/tcp