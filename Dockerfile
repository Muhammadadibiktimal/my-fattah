# Base Image PHP 8.3 dengan Apache
FROM php:8.3-apache

# Set environment composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install System Dependencies
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

# Disable mpm_event & mpm_worker, enable mpm_prefork (Fix AH00534: More than one MPM loaded)
RUN a2dismod mpm_event mpm_worker || true
RUN a2enmod mpm_prefork rewrite

# Configure & Install PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip

# Change Apache Root Directory to /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Working Directory
WORKDIR /var/www/html

# Copy Project Files
COPY . .

# Copy environment & setup
RUN cp .env.example .env
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
RUN npm install
RUN npm run build

RUN mkdir -p database storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views
RUN touch database/database.sqlite

RUN chmod +x /var/www/html/start.sh
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

ENTRYPOINT ["/var/www/html/start.sh"]
