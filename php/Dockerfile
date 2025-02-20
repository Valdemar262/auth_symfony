FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    apt-transport-https \
    ca-certificates \
    git \
    unzip \
    zip \
    zlib1g-dev \
    libpq-dev \
    build-essential \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN touch /var/log/xdebug.log && chmod 777 /var/log/xdebug.log

WORKDIR /var/www/app

USER root
