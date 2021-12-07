FROM php:8.0-cli-alpine

COPY . /usr/src/app
WORKDIR /usr/src/app

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-configure pcntl --enable-pcntl

RUN composer install

CMD [ "php", "./src/entrypoint.php" ]