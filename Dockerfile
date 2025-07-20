FROM php:8.3-apache

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql && docker-php-ext-enable pdo pdo_pgsql
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80