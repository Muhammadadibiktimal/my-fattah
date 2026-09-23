# Base Image PHP 8.3 dengan Apache (Cocok dengan Laravel 12 & dependencies)
FROM php:8.3-apache

# Set environment composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install System Dependencies & Extension Libraries
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev

# Configure GD Extension dengan support PNG & JPEG
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install PHP Extensions yang dibutuhkan Laravel & PhpSpreadsheet (GD)
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip

# Enable Apache Mod Rewrite
RUN a2enmod rewrite

# Change Apache Root Directory to /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer Resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Working Directory
WORKDIR /var/www/html

# Copy Project Files
COPY . .

# Setup Environment & Run Build (dengan --ignore-platform-reqs agar fleksibel)
RUN cp .env.example .env
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
RUN npm install
RUN npm run build

RUN php artisan key:generate
RUN mkdir -p database storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views
RUN touch database/database.sqlite

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 80

# Entrypoint Script saat container berjalan di Railway
CMD ["sh", "-c", "php artisan migrate:fresh --seed --force && php artisan storage:link || true && apache2-foreground"]
