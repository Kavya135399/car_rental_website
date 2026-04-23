# Car Rental (Laravel)

## Deploy (Docker)

This repository includes a `Dockerfile` and a startup script that will:

- create the `public/storage` symlink (`php artisan storage:link`)
- run database migrations (`php artisan migrate --force`)
- cache config/routes/views for production

### Platform options

- **Render / Fly.io / DigitalOcean App Platform**: easiest with Docker (recommended)
- **Shared hosting (cPanel)**: cheapest, but manual setup
- **VPS + Laravel Forge**: best control for production

### Required environment variables

Set these env vars in your hosting dashboard:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY` (generate locally: `php artisan key:generate --show`)
- `APP_URL` (set to your live domain, example: `https://your-domain.com`)
- `DB_CONNECTION=mysql`
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

Note: `config/database.php` also supports Railway-style MySQL variables like `MYSQLHOST`, `MYSQLPORT`, etc., but setting `DB_*` explicitly is recommended.

Optional toggles (container startup):

- `RUN_MIGRATIONS=true` (set to `false` to skip migrations on startup)
- `RUN_OPTIMIZE=true` (set to `false` to skip config/route/view caching)
- `STRICT_STARTUP=false` (set to `true` to make startup fail fast if migrations/caching fails)

## Preflight (verify before deploy)

Run this locally from `car-app` (Windows PowerShell):

- `powershell -ExecutionPolicy Bypass -File scripts/deploy-preflight.ps1`
