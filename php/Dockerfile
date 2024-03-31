FROM php:7.1-cli-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.9.8 \
    && docker-php-ext-enable xdebug

WORKDIR /app/
