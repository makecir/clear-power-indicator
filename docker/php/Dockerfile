# 開発・検証用の PHP 環境。PHP_VERSION を変えると PHP 8 系での動作も確認できる
ARG PHP_VERSION=7.4
FROM php:${PHP_VERSION}-apache

# PHP 7.4 の公式イメージは Debian 11 (bullseye) ベースで、セキュリティ更新が
# deb.debian.org から取得できなくなっているため archive.debian.org を使う
RUN if grep -q bullseye /etc/os-release; then \
        sed -i 's!deb.debian.org/debian-security!archive.debian.org/debian-security!' /etc/apt/sources.list; \
    fi \
    && apt-get update \
    && apt-get install -y --no-install-recommends libicu-dev libzip-dev unzip \
    && docker-php-ext-install intl pdo_mysql zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY docker/php/php.ini /usr/local/etc/php/conf.d/zz-app.ini
ENV PHP_MEMORY_LIMIT=128M

ENV APACHE_DOCUMENT_ROOT=/var/www/html/webroot
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

COPY docker/php/entrypoint.sh /usr/local/bin/app-entrypoint
RUN chmod +x /usr/local/bin/app-entrypoint

WORKDIR /var/www/html
ENTRYPOINT ["app-entrypoint"]
CMD ["apache2-foreground"]
