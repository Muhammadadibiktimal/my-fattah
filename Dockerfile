# Base Image PHP 8.3 CLI
FROM php:8.3-cli

ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Dependencies & Extension Libraries
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

# Install Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Working Directory
WORKDIR /var/www/html

# Copy Project Files
COPY . .

# Environment setup
RUN cp .env.example .env
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
RUN npm install
RUN npm run build

RUN mkdir -p database storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views
RUN touch database/database.sqlite
RUN php artisan key:generate --force
RUN php artisan migrate:fresh --seed --force
RUN php artisan storage:link --force || true

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 8000

# Server standalone Laravel bawaan yang kompatibel 100% dengan Railway PORT
CMD ["sh", "-c", "touch database/database.sqlite && php artisan migrate:fresh --seed --force || true && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
