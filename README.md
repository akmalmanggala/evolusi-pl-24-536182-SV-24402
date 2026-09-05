# Evolusi Perangkat Lunak - Praktikum Git & CI

Proyek aplikasi web Laravel yang dibangun untuk memenuhi tugas praktikum **Konstruksi dan Evolusi Perangkat Lunak (KEPL)**. Proyek ini mengimplementasikan alur kerja kolaborasi standar industri, mencakup *Conventional Commits*, *Branching Strategy* bertingkat, dan otomatisasi *Continuous Integration (CI)* menggunakan GitHub Actions.

## Fitur dan Spesifikasi
- **Framework**: Laravel 12 (PHP 8.2+)
- **Testing**: PHPUnit / Pest Framework
- **Code Style**: Laravel Pint Linter
- **CI/CD**: GitHub Actions (Workflow dengan 2 Jobs paralel)

## Alur Percabangan (Branching Strategy)
Proyek ini mengadopsi hierarki percabangan:
```text
main (Production)
└── dev (Integration)
    └── feature/homepage (Feature Development)
```

Setiap perubahan kode digabungkan secara bertingkat melalui mekanisme **Pull Request (PR)**:
1. `feature/homepage` ➔ `dev` (Pull Request #1)
2. `dev` ➔ `main` (Pull Request #2)

## Konvensi Commit (Conventional Commits)
Riwayat komit dikelola menggunakan standar semantik:
- `chore:` Pemeliharaan dasar, konfigurasi, inisialisasi berkas proyek.
- `feat:` Penambahan fitur atau antarmuka baru.
- `docs:` Pembaruan dokumentasi berkas proyek.
- `test:` Penambahan pengujian unit atau integrasi.
- `ci:` Konfigurasi skrip pipeline otomatisasi CI/CD.

## Menjalankan Proyek Secara Lokal
1. **Clone repositori**:
   ```bash
   git clone https://github.com/<username-kamu>/evolusi-pl-<NIM>.git
   cd evolusi-pl-<NIM>
   ```

2. **Install dependensi**:
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Jalankan Pengujian & Server**:
   ```bash
   php artisan test
   php artisan serve
   ```