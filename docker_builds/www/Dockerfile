FROM php:7.4-apache
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install mysqli
RUN pecl install xdebug-2.9.1
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    unzip
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini
RUN a2enmod rewrite
EXPOSE 80