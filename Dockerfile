# Gunakan PHP dengan FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    mysql-client npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer (dari image Composer resmi)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy semua file project Laravel
COPY . .

# Install dependencies Laravel
RUN composer install --optimize-autoloader --no-dev

# Buat permission agar folder bisa ditulis
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Buka port untuk Laravel
EXPOSE 8000

# Jalankan Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
