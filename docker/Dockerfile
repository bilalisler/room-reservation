FROM php:8.1.0-fpm
# Set working directory
WORKDIR /var/www

#install zip git nano unzip curl packages
RUN apt-get update && apt-get install -y \
    zip \
    nano \
    unzip \
    git \
    curl

# Install xDebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install OPCache
RUN docker-php-ext-install opcache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install Intl
RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Install APCu
RUN pecl install apcu \
        && docker-php-ext-enable apcu \
        && pecl clear-cache

RUN pecl install redis \
    && docker-php-ext-enable redis

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
