# ─────────────────────────────────────────────
# Game Edukasi Laravel — Dockerfile untuk Render
# PHP 8.2 + Apache
# ─────────────────────────────────────────────

FROM php:8.2-apache

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.9 /usr/bin/composer /usr/bin/composer

# Aktifkan mod_rewrite Apache untuk Laravel
RUN a2enmod rewrite

# Set document root ke public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set working directory
WORKDIR /var/www/html

# Copy composer files terlebih dahulu (layer caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (production only, tanpa dev)
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy seluruh source code project
COPY . .

# Jalankan post-install scripts setelah copy
RUN composer run-script post-autoload-dump || true

# Set permission untuk storage dan cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Buat database SQLite dan pastikan writable
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown www-data:www-data /var/www/html/database/database.sqlite \
    && chmod 664 /var/www/html/database/database.sqlite

# Copy script startup
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port 80
EXPOSE 80

# Jalankan startup script
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
