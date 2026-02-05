FROM php:8.2-apache

# MySQLi para PHP
RUN docker-php-ext-install mysqli

# Copiar proyecto al servidor web
COPY . /var/www/html/

# Hacer que Apache sirva desde /public
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

