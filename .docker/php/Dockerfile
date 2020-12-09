FROM php:7.2-alpine

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer


RUN docker-php-ext-install pdo_mysql mbstring \
    && docker-php-ext-enable pdo_mysql mbstring

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "./public", "./public/index.php"]
