FROM node:16-alpine as watch

ENV NODE_ENV=production

WORKDIR /app

ADD package.json yarn.lock webpack.config.js ./
ADD assets ./assets

RUN mkdir -p public && \
    NODE_ENV=devellopement yarn install && \
    yarn run build

FROM php:8.1.5-apache as php

USER root

RUN apt-get update -qq && \
    apt-get install -qy \
    libmariadb-dev \
    libzip-dev \
    libicu-dev \
    git \
    unzip
RUN docker-php-ext-configure intl
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd zip mysqli pdo pdo_mysql intl

WORKDIR /var/www/kotopo/

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

COPY apache.conf /etc/apache2/sites-available/000-default.conf

COPY --from=watch /var/www/kotopo/app /var/www/kotopo/app

RUN mkdir -p var && \
    APP_ENV=prod composer install --prefer-dist --optimize-autoloader --classmap-authoritative --no-interaction --no-ansi --no-dev && \
    APP_ENV=prod bin/console cache:clear --no-warmup && \
    APP_ENV=prod bin/console cache:warmup && \
    # We don't use DotEnv component as docker-compose will provide real environment variables
    echo "<?php return [];" > .env.local.php && \
    mkdir -p var/storage && \
    chown -R www-data:www-data var && \
    # Reduce container size
    rm -rf .git assets /root/.composer /tmp/*

RUN useradd -rm -d /home/symfony -s /bin/bash -g root -G sudo -u 1000 symfony
USER symfony