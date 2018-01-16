FROM php:7.2-fpm

MAINTAINER Matt Brunt <matt@mfyu.co.uk>

COPY 10-opcache-development.ini /usr/local/etc/php/conf.d/
COPY php.ini-development /usr/local/etc/php/php.ini
RUN usermod -u 1000 www-data
