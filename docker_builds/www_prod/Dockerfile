FROM php:7.4-apache
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    unzip
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd
RUN a2enmod rewrite
EXPOSE 80