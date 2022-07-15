FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    unzip

# Install libreoffice headless
RUN apt update -y \
    && mkdir -p /usr/share/man/man1 \
    && apt -y install default-jdk-headless libreoffice-writer

#&& apt -y install default-jdk-headless libreoffice-core libreoffice-writer libreoffice-calc

RUN mkdir -p /var/www/.cache/dconf \
    && mkdir -p /var/www/.config/libreoffice \
    && chmod -R ugo+rwx /var/www/.cache \
    && chmod -R ugo+rwx /var/www/.config

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
