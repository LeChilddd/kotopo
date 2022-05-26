FROM php:8.1.5-apache as php

USER root

RUN apt-get update -y && apt-get install -y libmariadb-dev libzip-dev
RUN docker-php-ext-install zip mysqli

WORKDIR /srv/app/

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

COPY apache.conf /etc/apache2/sites-available/000-default.conf

RUN useradd -rm -d /home/symfony -s /bin/bash -g root -G sudo -u 1000 symfony
USER symfony