FROM php:8.2-apache

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_MEMORY_LIMIT=-1

RUN apt-get update && apt-get install -y \
    git unzip curl \
    libcurl4-openssl-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml curl zip opcache \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts

COPY . .

RUN cp docker/000-default.conf /etc/apache2/sites-available/000-default.conf \
    && chmod +x docker/entrypoint.sh \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache || true

EXPOSE 80

ENTRYPOINT ["./docker/entrypoint.sh"]

