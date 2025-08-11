FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite agar .htaccess bekerja
RUN a2enmod rewrite

# Ganti konfigurasi apache agar AllowOverride aktif (untuk .htaccess)
COPY apache-config.conf /etc/apache2/sites-enabled/000-default.conf
