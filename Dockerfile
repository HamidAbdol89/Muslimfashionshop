# Dockerfile

FROM php:8.2-fpm

# Cài các package cần thiết
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
    libpq-dev \
    && apt-get clean

# Cài các PHP extension cần thiết
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Làm việc trong thư mục /var/www
WORKDIR /var/www

# Copy các file dự án vào container
COPY . .

# Cài đặt Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy file cấu hình nginx
COPY ./nginx.conf /etc/nginx/sites-available/default

# Expose port 80 cho nginx
EXPOSE 80

# Sử dụng lệnh khởi động đúng cách cho PHP-FPM và Nginx
CMD php-fpm & nginx -g "daemon off;"
