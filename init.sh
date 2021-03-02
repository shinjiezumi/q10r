#!/usr/bin/env bash

php composer.phar install
cp .env.example .env
php artisan key:generate
chmod -R a+w storage/ bootstrap/cache

php artisan migrate --seed
APP_ENV=testing php artisan migrate

yarn install
yarn run dev
