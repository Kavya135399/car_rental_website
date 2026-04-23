#!/usr/bin/env sh
set -eu

php artisan storage:link >/dev/null 2>&1 || true

php artisan config:cache
php artisan route:cache >/dev/null 2>&1 || true
php artisan view:cache >/dev/null 2>&1 || true

