<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Sample Tasks for KEPL Pertemuan 4
        Task::firstOrCreate([
            'title' => 'Praktikum KEPL P4: Integrasi Vue 3 & CI/CD',
        ], [
            'description' => 'Membangun frontend SPA Vue 3 dan mengintegrasikannya dengan REST API Laravel.',
            'is_completed' => true,
        ]);

        Task::firstOrCreate([
            'title' => 'Implementasi Unit Testing Vitest',
        ], [
            'description' => 'Menguji fungsi murni taskHelper secara mandiri di CI pipeline tanpa dependensi Laravel.',
            'is_completed' => true,
        ]);

        Task::firstOrCreate([
            'title' => 'Simulasi Circuit Breaker di GitHub Actions',
        ], [
            'description' => 'Menguji penghentian otomatis pipeline saat asersi pengujian sengaja digagalkan.',
            'is_completed' => false,
        ]);

        Task::firstOrCreate([
            'title' => 'Penyusunan Laporan Praktikum P4 (LaTeX)',
        ], [
            'description' => 'Menyusun laporan akademik format LaTeX sesuai panduan dan melampirkan screenshot pengujian.',
            'is_completed' => false,
        ]);

        Task::firstOrCreate([
            'title' => 'Review dan Merge Pull Request ke Branch Main',
        ], [
            'description' => 'Memvalidasi passing artifact dist/ dan verifikasi eksekusi penuh tahap deploy produksi.',
            'is_completed' => false,
        ]);
    }
}
