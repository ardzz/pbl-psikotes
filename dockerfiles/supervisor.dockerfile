FROM php:8.3-fpm-alpine

RUN apk add icu-dev libzip-dev oniguruma-dev

RUN docker-php-ext-install pdo pdo_mysql intl zip exif mbstring pcntl

RUN apk update && apk add --no-cache supervisor

RUN mkdir -p "/etc/supervisor/logs"

COPY ./supervisor/supervisord.conf /etc/supervisor/supervisord.conf

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]
