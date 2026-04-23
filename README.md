# Car Rental (Laravel)

## Deploy to Railway (Docker)

This repository includes a `Dockerfile` and a startup script that will:

- create the `public/storage` symlink (`php artisan storage:link`)
- run database migrations (`php artisan migrate --force`)
- cache config/routes/views for production

### 1) Create Railway services

1. Create a new Railway project.
2. Add a **MySQL** database to the project.
3. Add a **Web** service from your GitHub repo (set the service root to `car-app` if this is a monorepo).

### 2) Set Railway Variables

In the Web service, set these Variables (Environment Variables):

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY` (generate locally: `php artisan key:generate --show`)
- `APP_URL` (set to your Railway domain, example: `https://<your-domain>.up.railway.app`)
- `DB_CONNECTION=mysql`
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

Note: `config/database.php` also supports Railway-style MySQL variables like `MYSQLHOST`, `MYSQLPORT`, etc., but setting `DB_*` explicitly is recommended.

Optional toggles:

- `RUN_MIGRATIONS=true` (set to `false` to skip migrations on startup)
- `RUN_OPTIMIZE=true` (set to `false` to skip config/route/view caching)

### 3) Get the live link

After the first successful deploy:

1. Go to the Railway Web service → **Settings** → **Domains**.
2. Generate a domain.
3. Use the generated HTTPS URL as your live link (commonly ends with `.up.railway.app`).
