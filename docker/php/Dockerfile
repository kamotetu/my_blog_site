FROM php:7.3-apache-stretch

RUN apt-get update && \
    apt-get install -y libzip-dev zlib1g-dev && \
    docker-php-ext-install mysqli pdo_mysql zip && \
    a2enmod rewrite