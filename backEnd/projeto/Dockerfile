# Set master image for php
FROM php:8.0.0-alpine

# Copy composer.lock e composer.json
COPY composer.lock composer.json /var/www/html/

# seta o diretorio
WORKDIR /var/www/html

# Instalar dependencias

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-enable pdo_mysql

RUN docker-php-ext-enable pdo

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Expose port 9000 and start php-fpm server
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000