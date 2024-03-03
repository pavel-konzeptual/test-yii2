 # Базовый образ с apache
FROM php:8.2-apache

# Добавляем наше веб приложение
ADD . /var/www/app

# Удаляем конфиги сайтов которые там есть
RUN rm -Rf /etc/apache2/sites-enabled/*
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY . /var/www/app

RUN true
COPY ./scripts/ports.conf /etc/apache2/ports.conf
RUN true
# Добавляем наш конфиг
RUN true
ADD ./scripts/test-domen.ru.conf /etc/apache2/sites-available/test-domen.ru.conf
RUN true
# Включаем его
RUN ln -s /etc/apache2/sites-available/test-domen.ru.conf /etc/apache2/sites-enabled/test-domen.ru.conf