FROM dunglas/frankenphp:1.4.4-php8.3-alpine

RUN apk update \
    && apk add --no-cache \
    git \
    unzip \
    nano \
    supervisor

RUN install-php-extensions pcntl pdo pdo_mysql intl zip exif mbstring redis

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

COPY ./.docker/php/php.ini /usr/local/etc/php/
COPY ./.docker/etc/supervisor.d/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN chown -R www-data:www-data storage bootstrap/cache
# RUN chown -R www-data:www-data /var/www/html
RUN composer install

# RUN php artisan key:generate

EXPOSE 80 443

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/conf.d/supervisord.conf"]
