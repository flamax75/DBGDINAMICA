FROM php:8.3-apache

RUN docker-php-ext-install pdo_mysql
RUN a2enmod headers rewrite

COPY docker/apache.conf /etc/apache2/conf-available/dreambouw.conf
COPY docker/entrypoint.sh /usr/local/bin/dreambouw-entrypoint
RUN a2enconf dreambouw
RUN chmod +x /usr/local/bin/dreambouw-entrypoint

WORKDIR /var/www/html

ENTRYPOINT ["dreambouw-entrypoint"]
CMD ["apache2-foreground"]
