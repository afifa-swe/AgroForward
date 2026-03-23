FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    linux-headers \
    $PHPIZE_DEPS

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip \
    opcache

RUN pecl install redis && docker-php-ext-enable redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

USER www

EXPOSE 9000
CMD ["php-fpm"]
