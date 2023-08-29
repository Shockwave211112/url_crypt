#!/bin/bash

composer update

php artisan optimize:clear

php artisan optimize

php artisan migrate:fresh

php artisan db:seed

php artisan queue:work
