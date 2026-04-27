#!/bin/bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
apache2-foreground