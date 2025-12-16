FROM php:8.3-fpm

# تثبيت المتطلبات
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath

# تثبيت Redis Extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]
