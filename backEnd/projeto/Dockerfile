# Seta master image do php
FROM php:8.0.0-alpine

# Copia composer.lock e composer.json
COPY composer.lock composer.json /var/www/html/

# seta o diretorio
WORKDIR /var/www/html

# Instalar dependencias

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-enable pdo_mysql

RUN docker-php-ext-enable pdo

# Instalar PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Copy aplicacao
COPY --chown=www-data:www-data . /var/www/html

# Expose porta 8000 e start php-fpm server
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000