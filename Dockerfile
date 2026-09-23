# Base Image Node.js + PHP 8.2 Apache
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev

# Clear apt cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extension PHP
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip

# Enable Apache Mod Rewrite
RUN a2enmod rewrite

# Ganti DocumentRoot ke public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Copy environment & setup
RUN cp .env.example .env
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

RUN php artisan key:generate
RUN mkdir -p database storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views
RUN touch database/database.sqlite

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 80

# Entrypoint script saat container running
CMD ["sh", "-c", "php artisan migrate:fresh --seed --force && php artisan storage:link || true && apache2-foreground"]
