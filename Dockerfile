FROM php:8.2-cli

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip npm \
    && docker-php-ext-install zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copier le projet
COPY . .

# Installer dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer dépendances frontend
RUN npm install && npm run build

# Donner accès stockage
RUN chmod -R 777 storage bootstrap/cache

# Exposer port Render
EXPOSE 10000

# Lancer Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000