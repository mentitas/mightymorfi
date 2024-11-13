# Uso imagen de Composer como base
FROM composer:lts

# Copio el codigo al container
COPY ./laravel-project /var/www/html

# Set the working directory (Para exponer en APACHE)
WORKDIR /var/www/html

# INSTALACION NODE
RUN apk add --update nodejs npm

# Instalacion dependencias
RUN composer install

# Populacion DB
RUN php artisan migrate

# Set permissions (Para exponer en APACHE)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# BUILDEAR Y PUBLICAR APP EN SERVER PRUEBA
RUN npm install && npm run build

CMD php artisan serve --host 0.0.0.0

EXPOSE 8000/tcp