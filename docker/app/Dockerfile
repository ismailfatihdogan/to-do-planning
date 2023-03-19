FROM php:8.2.3-apache

ENV TZ Europe/Istanbul

RUN apt-get update \
    && apt-get install -y zlib1g-dev libbz2-dev libicu-dev libzip-dev supervisor \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip bz2 \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_mysql bcmath \
    && rm -rf /tmp/pear \
    && a2enmod rewrite

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY composer.lock composer.json ./
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

COPY ./docker/app/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker/app/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY ./docker/app/laravel-worker.conf /etc/supervisor/conf.d/supervisord.conf

COPY . .
RUN chown -R www-data:www-data storage bootstrap/cache
RUN mkdir -p "/etc/supervisor/logs"
# RUN mv .env.example .env
# RUN php artisan key:generate --ansi
