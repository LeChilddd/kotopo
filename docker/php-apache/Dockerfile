FROM php:8.1.5-apache as php

USER root

RUN apt-get update -y && apt-get install -y libmariadb-dev libzip-dev
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

# récupère l'extension nécessaire pour docker
RUN docker-php-ext-install zip mysqli pdo pdo_mysql

WORKDIR /var/www/kotopo

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

COPY apache.conf /etc/apache2/sites-available/000-default.conf

RUN useradd -rm -d /home/symfony -s /bin/bash -g root -G sudo -u 1000 symfony
USER symfony