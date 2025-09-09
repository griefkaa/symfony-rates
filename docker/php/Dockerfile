FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libicu-dev libzip-dev libonig-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony
