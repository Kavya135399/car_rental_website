FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl \
    libcurl4-openssl-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml curl zip opcache \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts

COPY . .

RUN chmod +x docker/entrypoint.sh \
    && chmod -R ug+rwX storage bootstrap/cache || true

EXPOSE 8080

ENTRYPOINT ["./docker/entrypoint.sh"]

