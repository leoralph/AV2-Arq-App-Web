FROM php:8.2-alpine

ENV UID=1000
ENV GID=1000

RUN apk add --no-cache tzdata \
    && cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime \
    && echo "America/Sao_Paulo" > /etc/timezone \
    && apk del tzdata

RUN apk add \
    openssl \
    openssl-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    linux-headers \
    $PHPIZE_DEPS \
    && docker-php-ext-install \
    pdo \
    zip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini \
    && rm -rf /var/cache/apk/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY start-container /usr/local/bin/start-container

RUN addgroup -g "$GID" -S app-user \
    && adduser -u "$UID" -S -G app-user app-user \
    && chmod +x /usr/local/bin/start-container

USER app-user

WORKDIR /app

ENTRYPOINT [ "start-container" ]
