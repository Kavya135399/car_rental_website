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

## Deploy (ApexWeave)

This repo works well with ApexWeave’s Git-based deploy workflow.

### 1) ApexWeave dashboard: build settings

Set these commands in your app’s **Settings → Build Configuration**:

- **Install**: `composer install --no-dev --optimize-autoloader --no-interaction --no-progress`
- **Build**: `sh scripts/apexweave-build.sh`
- **Start**: `sh scripts/apexweave-start.sh`
- **Port**: `8000`

Note: `public/build` is intentionally checked in so you don’t need Node/Vite during deploy.

### 2) Set environment variables

At minimum:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY=...` (generate locally: `php artisan key:generate --show`)
- `APP_URL=https://<your-app-domain>`
- `DB_CONNECTION=mysql`
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

### 3) Push to ApexWeave Git (deploy)

Add your ApexWeave Git remote and push:

- `git remote add apexweave <your-apexweave-git-url>`
- `git push apexweave main`

### 4) Run migrations (one-time / after schema changes)

From the ApexWeave CLI:

- `apexweave run "php artisan migrate --force" <your-app-domain>`
