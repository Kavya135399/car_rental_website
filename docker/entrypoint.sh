#!/usr/bin/env sh
set -u

cd /var/www/html

mkdir -p storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache || true

if [ -z "${APP_KEY:-}" ]; then
  export APP_KEY="$(php -r 'echo "base64:".base64_encode(random_bytes(32));')"
  echo "WARNING: APP_KEY was not set. Generated a temporary key for this container run."
  echo "Set a permanent APP_KEY in Railway Variables (use: php artisan key:generate --show) to avoid session/login issues."
fi

STRICT_STARTUP="${STRICT_STARTUP:-false}"

run_artisan() {
  cmd="$1"
  if php artisan $cmd; then
    return 0
  fi

  echo "WARNING: php artisan ${cmd} failed."
  if [ "$STRICT_STARTUP" = "true" ]; then
    echo "ERROR: STRICT_STARTUP=true so exiting."
    exit 1
  fi
  return 0
}

run_artisan "storage:link" >/dev/null 2>&1 || true

PORT_TO_BIND="${PORT:-8080}"

# Configure Apache to listen on the platform-assigned $PORT (common on PaaS).
if [ -f /etc/apache2/ports.conf ]; then
  sed -i "s/^Listen 80$/Listen ${PORT_TO_BIND}/" /etc/apache2/ports.conf || true
fi
if [ -f /etc/apache2/sites-available/000-default.conf ]; then
  sed -i "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT_TO_BIND}>/" /etc/apache2/sites-available/000-default.conf || true
fi

# Start the web server first so platform health checks can pass quickly,
# then do artisan work in the background.
apache2-foreground &
APACHE_PID="$!"

run_artisan "package:discover --ansi" >/dev/null 2>&1 || true

if [ "${RUN_MIGRATIONS:-true}" = "true" ] && [ -n "${DB_HOST:-${MYSQLHOST:-${MYSQL_HOST:-}}}" ]; then
  i=0
  until php artisan migrate --force; do
    i=$((i+1))
    if [ "$i" -ge 10 ]; then
      echo "WARNING: Migrations failed after ${i} attempts."
      if [ "$STRICT_STARTUP" = "true" ]; then
        echo "ERROR: STRICT_STARTUP=true so exiting."
        kill "$APACHE_PID" 2>/dev/null || true
        exit 1
      fi
      break
    fi
    echo "Migrations failed, retrying in 3s... (${i}/10)"
    sleep 3
  done
fi

if [ "${RUN_OPTIMIZE:-true}" = "true" ]; then
  run_artisan "config:clear" >/dev/null 2>&1 || true
  run_artisan "config:cache" || true
  run_artisan "route:cache" >/dev/null 2>&1 || true
  run_artisan "view:cache" >/dev/null 2>&1 || true
fi

wait "$APACHE_PID"
