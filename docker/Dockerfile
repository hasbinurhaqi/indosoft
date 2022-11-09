FROM php:8.1-fpm-alpine3.15

# Copy composer.lock and composer.json
COPY composer.json /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install prerequisites required for tools and extensions installed later on.
RUN apk add --update bash gnupg libpng-dev libzip-dev su-exec unzip shadow  xvfb ttf-dejavu ttf-droid ttf-freefont ttf-liberation mysql-client


# Retrieve the script used to install PHP extensions from the source container.
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

# Install required PHP extensions and all their prerequisites available via apt.
RUN chmod uga+x /usr/bin/install-php-extensions \
    && sync \
    && install-php-extensions mongodb bcmath ds exif gd intl opcache pcntl zip pdo pdo_mysql mysqli mbstring xml openssl json dom session zlib curl tokenizer xmlreader xmlwriter ctype sockets ldap

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Installing npm
RUN apk add --update nodejs npm

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Add UID '1000' to www-data
RUN usermod -u 1000 www-data

# Copy existing application directory permissions
ADD . /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage
RUN chmod -R 777 /var/www/html/storage/logs

# Copy PHP.INI
COPY docker/app/php.ini /usr/local/etc/php/

# Change current user to www
USER www-data

# Expose port 9000
EXPOSE 9000