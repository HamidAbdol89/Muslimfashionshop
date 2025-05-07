FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    nginx

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN php artisan config:clear
RUN php artisan config:cache

# Copy nginx configuration
COPY nginx/default.conf /etc/nginx/sites-available/default

# Expose the necessary ports
EXPOSE 8002

# Start both php-fpm and nginx
CMD service nginx start && php artisan serve --host=0.0.0.0 --port=8002
