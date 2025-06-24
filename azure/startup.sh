#!/bin/bash

cd /home/site/wwwroot

# Instala dependencias PHP
composer install --no-dev --optimize-autoloader

# Dar permisos a Laravel
chmod -R 775 storage bootstrap/cache

# Cachear configuración
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar servicios necesarios
service php8.2-fpm start

# Iniciar NGINX usando la configuración personalizada
nginx -c /home/site/wwwroot/azure/nginx.conf -g "daemon off;"
