FROM php:8.2-apache

# Cài extension và các package cần thiết
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install zip pdo pdo_mysql

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy toàn bộ project vào container
COPY . /var/www/html

# Set quyền cho Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache

EXPOSE 80
