#!/bin/bash
# filepath: c:\Users\Abraa\Documents\teste-fullstack\docker-entrypoint.sh

set -e

# Criar pastas tmp se não existirem
mkdir -p /var/www/html/app/tmp/cache/models
mkdir -p /var/www/html/app/tmp/cache/persistent
mkdir -p /var/www/html/app/tmp/cache/views
mkdir -p /var/www/html/app/tmp/logs
mkdir -p /var/www/html/app/tmp/sessions
mkdir -p /var/www/html/app/tmp/tests

# Criar pasta de uploads
mkdir -p /var/www/html/app/webroot/img/uploads

# Ajustar permissões
chown -R www-data:www-data /var/www/html/app/tmp
chmod -R 777 /var/www/html/app/tmp
chown -R www-data:www-data /var/www/html/app/webroot/img
chmod -R 777 /var/www/html/app/webroot/img

echo "Permissões configuradas!"

# Executar comando passado (apache2-foreground)
exec "$@"