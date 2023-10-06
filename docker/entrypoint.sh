#!/bin/bash

composer update

php artisan key:generate

php artisan optimize:clear

php artisan optimize

php artisan migrate:fresh --force

php artisan db:seed --force

php artisan queue:work
