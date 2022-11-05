FROM php:8-bullseye
COPY . /app
WORKDIR /app
RUN apt-get update && apt-get install unzip
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
