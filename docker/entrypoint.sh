#!/usr/bin/env sh
set -eu

cd /app

mkdir -p storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache || true

if [ -z "${APP_KEY:-}" ]; then
  echo "ERROR: APP_KEY is not set. Set it in Railway Variables (use: php artisan key:generate --show)."
  exit 1
fi

php artisan storage:link >/dev/null 2>&1 || true

php artisan package:discover --ansi >/dev/null 2>&1 || true

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
  php artisan migrate --force
fi

if [ "${RUN_OPTIMIZE:-true}" = "true" ]; then
  php artisan config:cache
  php artisan route:cache || true
  php artisan view:cache || true
fi

PORT_TO_BIND="${PORT:-8080}"
exec php -S "0.0.0.0:${PORT_TO_BIND}" -t public
