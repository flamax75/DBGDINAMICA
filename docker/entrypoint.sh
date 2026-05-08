#!/bin/sh
set -e

mkdir -p /var/www/html/storage
chown -R www-data:www-data /var/www/html/storage

exec docker-php-entrypoint "$@"
