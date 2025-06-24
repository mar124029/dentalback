#!/bin/bash

# Log de inicio
echo "[INFO] Startup script comenzando..." >> /home/site/wwwroot/startup.log

# Navegar al directorio del proyecto
cd /home/site/wwwroot

# Asegurar que el archivo tenga formato Unix (por si fue creado en Windows)
dos2unix /home/site/wwwroot/azure/startup.sh

# Instalar dependencias PHP sin las de desarrollo
composer install --no-dev --optimize-autoloader

# Asignar permisos necesarios para Laravel
chmod -R 775 storage bootstrap/cache

# Cachear configuración de Laravel
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar el servicio PHP-FPM
service php8.2-fpm start

# Log antes de iniciar NGINX
echo "[INFO] Iniciando nginx personalizado" >> /home/site/wwwroot/startup.log

# Iniciar nginx con la configuración personalizada
nginx -c /home/site/wwwroot/azure/nginx.conf -g "daemon off;"
