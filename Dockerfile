# Dockerfile pour QCMed - Application Laravel/Filament
FROM php:8.4-fpm-alpine

# Arguments de build
ARG USER_ID=1000
ARG GROUP_ID=1000

# Installation des dépendances système
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    icu-dev \
    oniguruma-dev \
    nodejs \
    npm \
    sqlite \
    sqlite-dev \
    supervisor \
    nginx

# Configuration et installation des extensions PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_sqlite \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        intl \
        zip \
        opcache

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# www-data est déjà créé par l'image PHP, on ajuste juste les permissions

# Configuration du répertoire de travail
WORKDIR /var/www/html

# Copie des fichiers de configuration Composer en premier (pour le cache Docker)
COPY composer.json composer.lock ./

# Installation des dépendances PHP (avec dev pour les seeders, puis nettoyage)
RUN composer install --no-scripts --no-autoloader --prefer-dist

# Copie des fichiers package.json
COPY package.json package-lock.json ./

# Installation des dépendances Node.js
RUN npm ci

# Copie du reste de l'application
COPY . .

# Génération de l'autoloader optimisé et exécution des scripts
RUN composer dump-autoload --optimize \
    && composer run-script post-autoload-dump || true

# Build des assets frontend
RUN npm run build

# Configuration des permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Création du répertoire pour SQLite
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/database

# Copie des fichiers de configuration
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Exposition du port
EXPOSE 80

# Script d'entrée
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
