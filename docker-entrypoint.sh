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
chmod -R 777 /var/www/html/app/Console/cake

echo "Permissões configuradas!"

# Aguardar MySQL estar pronto
echo "Aguardando MySQL..."
while ! php -r "new PDO('mysql:host=mysql;dbname=doity', 'root', 'root');" 2>/dev/null; do
    sleep 2
done
echo "MySQL está pronto!"

# Rodar migrations e seed apenas na primeira vez
if [ ! -f /var/www/html/.migrated ]; then
    echo "Criando tabelas..."
    cd /var/www/html
    app/Console/cake schema create --yes
        
    touch /var/www/html/.migrated
    echo "Migração concluída!"
fi

# Executar comando passado (apache2-foreground)
exec "$@"