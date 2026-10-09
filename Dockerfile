# ==============================================================================
# Stage 1: Build Dependencies (Builder Stage)
# ==============================================================================
# Menggunakan base image PHP 8.2 Alpine resmi dengan versi terkunci
FROM php:8.2-cli-alpine AS builder

WORKDIR /var/www

# Install build tools & dependensi sistem yang dibutuhkan untuk kompilasi
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    && docker-php-ext-install bcmath

# Ambil executable Composer resmi versi terkunci (2.8.5)
COPY --from=composer:2.8.5 /usr/bin/composer /usr/bin/composer

# Optimasi caching layer: salin manifest dependensi terlebih dahulu
COPY composer.json composer.lock ./

# Pasang dependensi production (tanpa dev tools dan tanpa script)
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction --optimize-autoloader

# Salin seluruh kode aplikasi (file non-esensial dikecualikan oleh .dockerignore)
COPY . .

# Siapkan file environment dan kunci aplikasi
RUN rm -f bootstrap/cache/*.php \
    && cp -n .env.example .env \
    && php artisan key:generate

# Optimalkan autoloader classmap
RUN composer dump-autoload --optimize --no-dev

# Inisialisasi basis data SQLite dan seed data awal
RUN touch database/database.sqlite \
    && php artisan migrate --force --seed

# Konfigurasi perizinan direktori pada stage builder
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/database \
    && chmod 664 /var/www/database/database.sqlite


# ==============================================================================
# Stage 2: Minimal Runtime (Production Runner Stage)
# ==============================================================================
# Menggunakan runtime PHP 8.2 Alpine yang bersih dan minimal
FROM php:8.2-cli-alpine AS runner

WORKDIR /var/www

# Hanya install pustaka runtime yang benar-benar dibutuhkan aplikasi (curl untuk HEALTHCHECK)
# Alat-alat build (git, unzip, composer, compiler) TIDAK disertakan di stage ini
RUN apk add --no-cache curl \
    && docker-php-ext-install bcmath \
    && rm -rf /var/cache/apk/*

# Salin aplikasi lengkap dari stage builder langsung dengan hak milik www-data
# Menggunakan flag --chown agar TIDAK tercipta layer duplikasi (menghemat puluhan MB)
COPY --from=builder --chown=www-data:www-data /var/www /var/www

# Ganti user aktif ke non-root (www-data) demi keamanan container
USER www-data

# Konfigurasi HEALTHCHECK untuk memantau endpoint kesehatan aplikasi
HEALTHCHECK --interval=10s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8000/api/health || exit 1

# Ekspos port aplikasi
EXPOSE 8000

# Perintah utama untuk menjalankan aplikasi Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
