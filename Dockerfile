# Utilise une image PHP-FPM
FROM php:8.1-fpm

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    git \
    unzip \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier le fichier composer.json et installer les dépendances
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-interaction

# Copier le reste du projet
COPY . .

# Générer l'autoloader optimisé
RUN composer dump-autoload --optimize

# Exposer le port utilisé par PHP-FPM
EXPOSE 9000

# Démarrer PHP-FPM
CMD ["php-fpm"]