#!/bin/bash
composer dump-autoload
php artisan migrate:fresh
cp .env.example .env
php artisan storage:link
php artisan key:generate
