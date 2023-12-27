FROM php:8.2-apache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-install mysqli

RUN apt-get update -y && apt-get install -y \
    libyaml-dev \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    zlib1g-dev

RUN pecl install yaml && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini && docker-php-ext-enable yaml
RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install mbstring
RUN docker-php-ext-enable opcache

RUN a2enmod rewrite

ADD ./apache.conf /etc/apache2/sites-available/000-default.conf
RUN ln -sf /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN chown -R www-data:www-data /var/www

USER www-data
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN echo 'PATH=$PATH:/var/www/.symfony5/bin/' >> /var/www/.bashrc

USER root
