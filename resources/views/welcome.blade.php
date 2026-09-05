<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evolusi PL - Praktikum Git & CI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .container { max-width: 860px; width: 100%; }
        .badge {
            display: inline-block;
            background: rgba(56, 189, 248, 0.1);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.2);
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
            line-height: 1.25;
        }
        p.subtitle {
            color: #8b949e;
            font-size: 1.05rem;
            margin-bottom: 2rem;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        .card {
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 0.75rem;
            padding: 1.5rem;
            transition: transform 0.2s, border-color 0.2s;
        }
        .card:hover {
            transform: translateY(-3px);
            border-color: #58a6ff;
        }
        .card-title {
            color: #58a6ff;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .card-desc {
            color: #8b949e;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        .info-box {
            background: #161b22;
            border: 1px solid #238636;
            border-radius: 0.75rem;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: gap: 1rem;
        }
        .status-dot {
            height: 10px;
            width: 10px;
            background-color: #238636;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            box-shadow: 0 0 8px #238636;
        }
        footer {
            margin-top: 2.5rem;
            text-align: center;
            color: #484f58;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <span class="badge">Praktikum Konstruksi & Evolusi Perangkat Lunak 2026</span>
        <h1>Evolusi Perangkat Lunak</h1>
        <p class="subtitle">Manajemen Repositori, Branching Strategy Bertingkat, dan Continuous Integration pada Laravel Framework.</p>

        <div class="grid">
            <div class="card">
                <div class="card-title">Branching Strategy</div>
                <div class="card-desc">Menggunakan tiga tingkat percabangan: <code>main</code> (produksi), <code>dev</code> (integrasi), dan <code>feature/*</code> (pengembangan fitur terisolasi).</div>
            </div>
            <div class="card">
                <div class="card-title">Conventional Commits</div>
                <div class="card-desc">Riwayat perubahan terdokumentasi terstruktur dengan tipe semantik (<code>feat</code>, <code>chore</code>, <code>docs</code>, <code>test</code>, <code>ci</code>).</div>
            </div>
            <div class="card">
                <div class="card-title">Continuous Integration</div>
                <div class="card-desc">GitHub Actions otomatis mengeksekusi 2 job: validasi standar kode (Pint) dan pengujian unit/fitur (PHPUnit).</div>
            </div>
        </div>

        <div class="info-box">
            <div>
                <span class="status-dot"></span>
                <strong>Status Sistem:</strong> Aplikasi Laravel berhasil terpasang dan siap digunakan.
            </div>
            <span style="color: #8b949e; font-size: 0.9rem;">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
        </div>

        <footer>
            Departemen Teknik Elektro dan Informatika &bull; Sekolah Vokasi Universitas Gadjah Mada &bull; 2026
        </footer>
    </div>
</body>
</html>
