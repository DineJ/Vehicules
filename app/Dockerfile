FROM php:fpm

# Installe les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql mysqli \
    && docker-php-ext-enable intl mysqli

# Définit le répertoire de travail
WORKDIR /var/www/html

# Copie le code de l’application dans le conteneur
COPY . .

# Démarre PHP-FPM
CMD ["php-fpm", "-F"]
