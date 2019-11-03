#!/usr/bin/env bash

cd /var/www/html

php composer.phar install
cp .env.example .env
php artisan key:generate
chmod -R a+w storage/ bootstrap/cache

yarn install