#!/usr/bin/env sh
set -eu

cd /var/www/html 2>/dev/null || true

PORT_TO_BIND="${PORT:-8000}"

# If the platform injects a different port env var, prefer it.
if [ -n "${APEXWEAVE_PORT:-}" ]; then
  PORT_TO_BIND="$APEXWEAVE_PORT"
fi

exec php artisan serve --host=0.0.0.0 --port="$PORT_TO_BIND"

