# FROM php:fpm

# RUN docker-php-ext-install pdo pdo_mysql
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


FROM php:fpm

# Install required PHP extensions and tools
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql \
    && apt-get clean

# Copy Composer from the Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app