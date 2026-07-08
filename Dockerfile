# Dockerfile para desplegar Juegogos en Render.
# Render espera que la app escuche en el puerto 10000 (o el que
# configures en la variable PORT). Apache por defecto usa 80,
# asi que lo cambiamos aqui.

FROM php:8.2-apache

# Instalar la extension mysqli (la usan todos los modelos)
RUN docker-php-ext-install mysqli

# Copiar todo el proyecto dentro del contenedor
COPY . /var/www/html/

# Cambiar el DocumentRoot de Apache a la carpeta public/
# (asi no se puede navegar a app/ ni config/ desde el navegador)
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' \
      /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

# Render usa el puerto 10000 por defecto; cambiar Apache para que escuche ahi
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf && \
    sed -i 's/:80/:10000/' /etc/apache2/sites-available/000-default.conf

EXPOSE 10000
