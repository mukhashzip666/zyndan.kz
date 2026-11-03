#!/bin/bash
set -e

# Создаем папки если отсутствуют
mkdir -p /var/www/html/public/uploads/large \
         /var/www/html/public/uploads/medium \
         /var/www/html/public/uploads/original \
         /var/www/html/public/uploads/thumbnail \
         /var/www/html/logs

# Назначаем права для веб-сервера
chown -R www-data:www-data /var/www/html/public/uploads /var/www/html/logs /var/www/html/config
chmod -R 775 /var/www/html/public/uploads /var/www/html/logs /var/www/html/config

exec "$@"

