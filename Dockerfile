# Use an official PHP runtime as a parent image
FROM php:8.0-fpm

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        curl \
        git \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        unzip \
        zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-scripts --no-autoloader

# Copy the rest of the application files to the container
COPY . .

# Generate autoload files
RUN composer dump-autoload --optimize

# Set permissions for Laravel storage and bootstrap cache
RUN chgrp -R www-data storage bootstrap/cache && \
    chmod -R ug+rwx storage bootstrap/cache

# Expose port 9000
EXPOSE 9000

# Set the command to start the app
CMD ["php-fpm"]
