ARG PHP_BASE_IMAGE_VERSION
FROM php:${PHP_BASE_IMAGE_VERSION}

# Install modules
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd opcache \
    && curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/bin --filename=composer

COPY ./php.ini /usr/local/etc/php/
COPY ./php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./docker-php-entrypoint /usr/local/bin/

USER root
RUN addgroup -g 1000 app && addgroup www-data app
RUN adduser -u 1000 -s /bin/sh -D -G app app
USER www-data

WORKDIR /app

ENTRYPOINT ["docker-php-entrypoint"]
CMD ["php-fpm"]
