# Sirve la carpeta public/ como raiz del sitio.
FROM php:8.2-apache
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' \
      /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf
EXPOSE 80
