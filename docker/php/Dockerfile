FROM php:7.3-apache-stretch

RUN apt-get update && \
    apt-get install -y libzip-dev zlib1g-dev sudo nano && \
    docker-php-ext-install mysqli pdo_mysql zip && \
    a2enmod rewrite

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer