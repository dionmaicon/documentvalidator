FROM php:7.2-apache

COPY ./backend /var/www/html

EXPOSE 8080:80
EXPOSE 8081:8081

RUN apt-get update
RUN apt-get install openssl libssl-dev libcurl4-openssl-dev -y
RUN apt-get install git -y

RUN pecl install mongodb
RUN echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/bin --file-name=composer

RUN php -r "unlink('composer-setup.php');"
RUN mv /bin/composer.phar /bin/composer

WORKDIR /var/www/html

RUN chown -R $USER:$USER /var/www/html
