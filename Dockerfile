FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

COPY . .

RUN chmod +x docker/entrypoint.sh \
    && chmod -R ug+rwX storage bootstrap/cache || true

EXPOSE 8080

ENTRYPOINT ["./docker/entrypoint.sh"]

