FROM php:8.2-apache

RUN docker-php-ext-install mysqli

WORKDIR /var/www/html
COPY --chown=www-data:www-data . .
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

CMD ["docker-entrypoint.sh"]
