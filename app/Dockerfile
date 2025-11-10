FROM php:8.2-fpm

# Installe les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Définit le répertoire de travail
WORKDIR /var/www/html

# Copie le code de l’application
COPY . .

# Démarre PHP-FPM (et non php -a)
CMD ["php-fpm", "-F"]

