#!/bin/sh

# Installer les dépendances PHP
composer install --no-dev --optimize-autoloader --classmap-authoritative

# Exécuter les migrations de la base de données
# php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

# Charger les fixtures (si nécessaire)
# php bin/console doctrine:fixtures:load --no-interaction

# Lancer Apache (ou tout autre service principal)
exec apache2-foreground
