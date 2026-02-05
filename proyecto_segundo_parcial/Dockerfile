FROM php:8.2-apache

RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

# Copiar el proyecto (desde PROYECTO_SEGUNDO_PARCIAL) al DocumentRoot
COPY . /var/www/html/

# Apache debe servir desde /public
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
