# ── Stage 1: Base Image ──────────────────────────────────────────────────────
# Menggunakan image resmi PHP 8.2 Alpine (ringan, minimalis, dan aman)
FROM php:8.2-cli-alpine

# Menentukan direktori kerja di dalam container
WORKDIR /var/www

# Memasang dependensi sistem dan pustaka ekstensi PHP yang dibutuhkan Laravel
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    && docker-php-ext-install bcmath

# Menyalin executable Composer resmi dari image composer:2
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ── Optimasi Layer Caching Dependensi ────────────────────────────────────────
# Salin berkas manifest dependensi terlebih dahulu (Langkah 3 Penugasan)
COPY composer.json composer.lock ./

# Pasang dependensi PHP sebelum kode aplikasi disalin (memaksimalkan cache layer)
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction

# ── Penyalinan Kode Aplikasi ────────────────────────────────────────────────
# Salin seluruh kode aplikasi (file sensitif diabaikan oleh .dockerignore)
COPY . .

# Bersihkan cache bootstrap lama dan siapkan environment
RUN rm -f bootstrap/cache/*.php && cp -n .env.example .env && php artisan key:generate

# Generate autoload classmap yang optimal untuk performa
RUN composer dump-autoload --optimize

# Inisialisasi basis data SQLite dan data awal (seeder)
RUN touch database/database.sqlite && php artisan migrate --force --seed

# Dokumentasi port jaringan yang digunakan oleh server Laravel
EXPOSE 8000

# Perintah utama saat container dijalankan
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
