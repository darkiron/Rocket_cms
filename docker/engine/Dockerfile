FROM dunin/docker-php-7.1.6-fpm
MAINTAINER Scharpen Vincent <darkiron90@gmail.com>
ADD . /code
WORKDIR /code
RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-source delete \
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
RUN chmod +x /usr/local/bin/composer
