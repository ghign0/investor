FROM php:8.1.0-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev wget \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install sockets \
    && docker-php-ext-install zip

# Enable php8-xdebug if $PHP_XDEBUG_MODE is not empty
ARG PHP_XDEBUG_MODE=off
ARG PHP_XDEBUG_CLIENT_PORT=5902
ARG PHP_XDEBUG_CLIENT_HOST=host.docker.internal
COPY ./docker/php-fpm/xdebug.ini  /etc/php8/conf.d/xdebug.ini.template

RUN if [[ "$PHP_XDEBUG_MODE" != "" ]]; then \
        apt apt install php-xdebug; \
        export PHP_XDEBUG_MODE=$PHP_XDEBUG_MODE; \
        export PHP_XDEBUG_CLIENT_PORT=$PHP_XDEBUG_CLIENT_PORT; \
        export PHP_XDEBUG_CLIENT_HOST=$PHP_XDEBUG_CLIENT_HOST; \
        envsubst < /etc/php8/conf.d/xdebug.ini.template > /etc/php8/conf.d/xdebug.ini; \
    fi
RUN rm -f /etc/php8/conf.d/xdebug.ini.template

# Config composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#ARG COMPOSER_AUTH_TOKEN
#RUN composer config -g github-oauth.github.com ${COMPOSER_AUTH_TOKEN}

ARG SYMFONY_CLI_VERSION
RUN wget https://github.com/symfony/cli/releases/download/v$SYMFONY_CLI_VERSION/symfony_linux_amd64.gz \
    && gzip -d symfony_linux_amd64.gz \
    && mv symfony_linux_amd64 symfony \
    && chmod +x symfony \
    && mv symfony /usr/local/bin/


COPY ./docker/php-fpm/symfony.ini /etc/php8/conf.d/
COPY ./docker/php-fpm/symfony.ini /etc/php8/cli/conf.d/

COPY ./docker/php-fpm/symfony.pool.conf /etc/php8/php-fpm.d/

ARG PROJECT_ROOT_DIRECTORY
WORKDIR $PROJECT_ROOT_DIRECTORY
