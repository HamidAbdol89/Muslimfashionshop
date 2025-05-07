FROM php:8.2-fpm

# Cài package cần thiết
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev

# PHP extension
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Làm việc trong /var/www
WORKDIR /var/www

COPY . .

# Cài đặt Laravel
RUN composer install --optimize-autoloader --no-dev \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Copy nginx config
COPY ./nginx.conf /etc/nginx/sites-available/default

# Expose default port 80
EXPOSE 80

# Start PHP-FPM và Nginx
CMD service php8.2-fpm start && nginx -g "daemon off;"
