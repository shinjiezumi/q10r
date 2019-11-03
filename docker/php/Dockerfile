FROM php:7.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    zip \
    unzip \
    iputils-ping \
    vim

RUN docker-php-ext-install pdo_mysql

RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -
RUN apt-get install -y --no-install-recommends nodejs

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y --no-install-recommends yarn