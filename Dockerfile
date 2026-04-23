FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www/html

RUN composer install --no-dev --optimize-autoloader

# Apache root -> public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Create writable folders
RUN mkdir -p \
    /tmp/php-temp \
    storage/framework/views \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/logs \
    bootstrap/cache \
 && chown -R www-data:www-data /var/www/html /tmp/php-temp \
 && chmod -R 777 /tmp/php-temp \
 && chmod -R 775 storage bootstrap/cache

# Force PHP temp dirs
ENV TMPDIR=/tmp/php-temp
ENV TEMP=/tmp/php-temp
ENV TMP=/tmp/php-temp

RUN php artisan optimize:clear || true

EXPOSE 80
CMD ["apache2-foreground"]