FROM php:8.2-apache

# Instala extensões do PHP para o MySQL (PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Copia os arquivos do projeto para o diretório web do Apache
COPY . /var/www/html/

# Configura as permissões
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
