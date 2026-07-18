FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

RUN { \
    echo '<Directory ${APACHE_DOCUMENT_ROOT}>'; \
    echo '    Options Indexes FollowSymLinks'; \
    echo '    AllowOverride All'; \
    echo '    Require all granted'; \
    echo '</Directory>'; \
} >> /etc/apache2/apache2.conf

RUN apt-get update && apt-get install -y libpng-dev \
 && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY --chown=www-data:www-data . /var/www/html
