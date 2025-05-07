FROM php:8.2-fpm

# Install dependencies
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

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy the application files
COPY . .

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy nginx config
COPY ./nginx.conf /etc/nginx/sites-available/default

# Expose default port 80
EXPOSE 80

# Start PHP-FPM and Nginx
CMD service php8.2-fpm start && nginx -g "daemon off;"
