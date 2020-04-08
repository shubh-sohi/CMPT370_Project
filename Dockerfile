FROM php:7.3-apache

RUN apt-get update && apt-get install -y

RUN docker-php-ext-install mysqli pdo_mysql

RUN mkdir /app \
 && mkdir /app/shubh-php-mysql-demo \
 && mkdir /app/shubh-php-mysql-demo/www

COPY www/ /app/shubh-php-mysql-demo/www/

RUN cp -r /app/shubh-php-mysql-demo/www/* /var/www/html/.
