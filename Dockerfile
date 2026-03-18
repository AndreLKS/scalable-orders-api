FROM php:8.5.1-cli

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# instala redis extension
RUN pecl install redis && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD php artisan serve --host=0.0.0.0 --port=8000