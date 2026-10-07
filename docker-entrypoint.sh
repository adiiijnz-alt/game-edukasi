#!/bin/bash
set -e

echo "========================================"
echo "  Game Edukasi — Laravel Startup Script"
echo "========================================"

# Buat .env dari environment variables jika belum ada
if [ ! -f /var/www/html/.env ]; then
    echo "📄 Membuat .env dari environment variables..."
    cat > /var/www/html/.env << EOF
APP_NAME="${APP_NAME:-Game Edukasi}"
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=${DB_CONNECTION:-sqlite}
DB_DATABASE=${DB_DATABASE:-/var/www/html/database/database.sqlite}

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

CACHE_STORE=file

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME:-Game Edukasi}"

VITE_APP_NAME="${APP_NAME:-Game Edukasi}"
EOF
    echo "✅ .env berhasil dibuat"
else
    echo "✅ .env sudah ada"
fi

# Pastikan APP_KEY di .env
if grep -q "APP_KEY=$" /var/www/html/.env || ! grep -q "APP_KEY=" /var/www/html/.env; then
    if [ -n "$APP_KEY" ]; then
        sed -i "s|APP_KEY=.*|APP_KEY=${APP_KEY}|" /var/www/html/.env
        echo "✅ APP_KEY diset dari environment"
    fi
fi

# Set permission storage
echo "🔐 Setting permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

# Buat SQLite database jika belum ada
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "🗄️  Membuat SQLite database..."
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# Jalankan migration
echo "🗄️  Menjalankan database migration..."
cd /var/www/html
php artisan migrate --force --no-interaction 2>/dev/null || echo "⚠️  Migration warning (mungkin sudah dijalankan)"

# Clear dan optimize cache
echo "🚀 Optimizing Laravel..."
php artisan optimize:clear 2>/dev/null || true
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Storage link
echo "🔗 Creating storage link..."
php artisan storage:link 2>/dev/null || true

echo "========================================"
echo "  ✅ Laravel siap! Menjalankan Apache..."
echo "========================================"

# Jalankan Apache
exec "$@"
