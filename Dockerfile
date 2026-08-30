FROM php:8.2-apache

# Instala dependências do PostgreSQL e extensões do PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copia os arquivos do projeto para o servidor web
COPY . /var/www/html/

# Ajusta permissões dos arquivos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
