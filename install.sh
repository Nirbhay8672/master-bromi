#!/bin/sh
# composer install --ignore-platform-reqs
composer install
# composer install --optimize-autoloader --no-dev
php artisan migrate:fresh --seed
php artisan passport:install
sudo chmod -R 777 storage/
sudo mkdir -p public/upload
sudo chmod -R 777 public/upload