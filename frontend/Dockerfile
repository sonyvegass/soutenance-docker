# Utilisation de l'image PHP avec Apache
FROM php:7.4-apache

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install mysqli

# Installation du client MySQL
RUN apt-get update && apt-get install -y default-mysql-client

# Copie des fichiers du front-end dans le répertoire de travail de l'image
COPY . /var/www/html/

# Exposition du port 80
EXPOSE 80
