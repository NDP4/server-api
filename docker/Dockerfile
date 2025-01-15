FROM php:8.0-fpm-buster

# Configure timezone
ENV TZ=Asia/Bangkok

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    zip

# Configure PHP
COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini

# Set working directory
WORKDIR /var/www/html
