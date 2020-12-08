FROM php:7.2-alpine

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "./public", "./public/index.php"]
