# Utilisation de l'image PHP avec Apache
FROM php:7.4-apache

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activer le module PHP d'Apache
RUN docker-php-ext-enable mysqli

# Activer le module rewrite d'Apache
RUN a2enmod rewrite

# Copie des fichiers du back-end dans le répertoire de travail de l'image
COPY . /var/www/html/

# Configuration du fichier index par défaut
RUN echo "DirectoryIndex login.php" > /var/www/html/.htaccess

# Exposition du port 80
EXPOSE 80

