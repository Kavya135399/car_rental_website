FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Create Laravel writable folders
RUN mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    /tmp/php-temp \
 && chmod -R 777 storage bootstrap/cache /tmp/php-temp

# Use writable temp directory
ENV TMPDIR=/tmp/php-temp
ENV PHP_TEMP_DIR=/tmp/php-temp

EXPOSE 10000

CMD php artisan optimize:clear && \
    php artisan config:cache && \
    php artisan serve --host=0.0.0.0 --port=10000