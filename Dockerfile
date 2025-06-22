FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql intl zip exif mbstring

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

