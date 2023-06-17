FROM php:8.0 as php 

# PHP
RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

WORKDIR /var/www
COPY . .

COPY --from=composer:latest  /usr/bin/composer /usr/bin/composert

ENV PORT=1011
ENTRYPOINT [ "docker/entrypoint.sh" ]