FROM php:8.1.5-apache


USER root

RUN apt-get update -y && apt-get install -y libmariadb-dev
RUN docker-php-ext-install zip mysqli

WORKDIR /var/www/kotopo

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN apt update && apt install -yqq nodejs npm zip unzip

COPY apache.conf /etc/apache2/sites-available/000-default.conf
