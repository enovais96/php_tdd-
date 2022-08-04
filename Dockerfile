FROM php:7.4-apache
RUN docker-php-ext-install mysqli

RUN apt-get upgrade
RUN apt-get update
RUN apt-get install -y --no-install-recommends git zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY www/composer.json /var/www/html/composer.json

RUN composer install
RUN chmod -R 775 ./vendor