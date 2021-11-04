FROM php:7.4-fpm

WORKDIR /var/www/myapp

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get install zip unzip
COPY composer.json ./
COPY composer.lock ./
RUN curl -sS "https://getcomposer.org/installer" -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN composer update
