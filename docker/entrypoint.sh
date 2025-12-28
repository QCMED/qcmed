#!/bin/sh
set -e

# Création des répertoires nécessaires
mkdir -p /var/log/supervisor
mkdir -p /var/log/php
mkdir -p /var/lib/php/sessions
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/bootstrap/cache

# Configuration des permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/database
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Génération de la clé d'application si nécessaire
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Vérifier si APP_KEY est défini
if ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
    php artisan key:generate --force
fi

# Configuration pour SQLite
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
fi

# Exécution des migrations
php artisan migrate --force

# Seeding si la base est vide (premier démarrage)
USER_COUNT=$(php artisan tinker --execute="echo \App\Models\User::count();" 2>/dev/null | grep -E '^[0-9]+$' | head -1)
if [ "$USER_COUNT" = "0" ] || [ -z "$USER_COUNT" ]; then
    echo "Base de données vide, exécution des seeders..."
    php artisan db:seed --force || echo "Seeders échoués (mode production)"
fi

# Création du lien symbolique pour le storage
php artisan storage:link 2>/dev/null || true

# Optimisation pour la production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components

echo "QCMed est prêt !"
echo "Accès Admin: http://localhost/admin"
echo "Accès Étudiant: http://localhost/student"

# Exécution de la commande principale
exec "$@"
