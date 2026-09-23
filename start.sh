#!/bin/sh
set -e

# Port Binding Railway
PORT="${PORT:-80}"
sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf || true

# Generate Key & Database Setup jika belum ada
php artisan key:generate --force || true
touch /var/www/html/database/database.sqlite || true
php artisan migrate:fresh --seed --force || true
php artisan storage:link --force || true

# Disable mpm_event & mpm_worker secara eksplisit di runtime, enable mpm_prefork
a2dismod mpm_event mpm_worker || true
a2enmod mpm_prefork || true

# Jalankan Apache Web Server
exec apache2-foreground
