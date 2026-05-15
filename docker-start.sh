#!/bin/bash
php artisan migrate --force
php artisan optimize
apache2-foreground