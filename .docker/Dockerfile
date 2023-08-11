FROM php:7.4-fpm

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libzip-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip

RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www
RUN echo "upload_max_filesize=30M;" >> "$PHP_INI_DIR/php.ini-production"
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
