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

# Run composer install
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN php artisan config:clear
RUN php artisan config:cache

# Copy Nginx configuration from the root of your project
COPY ./nginx.conf /etc/nginx/sites-available/default

# Expose ports
EXPOSE 8002


# Start Nginx and PHP-FPM
CMD service nginx start && php artisan serve --host=0.0.0.0 --port=8002
