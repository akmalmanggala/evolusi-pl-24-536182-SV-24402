<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <!-- Hero Card -->
        <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 p-4">
          <div class="row align-items-center">
            <div class="col-md-8">
              <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-2 rounded-pill fw-semibold">
                Praktikum KEPL 2026 &bull; Pertemuan 4
              </span>
              <h2 class="fw-bold text-dark mb-2">
                Modern Frontend dengan Vue 3 &amp; Otomasi CI/CD
              </h2>
              <p class="text-secondary mb-3">
                Aplikasi Single Page Application (SPA) berbasis Vue 3 dan Vite yang terhubung ke RESTful API Laravel, dilengkapi pengujian unit Vitest dan alur kerja CI/CD 4-tahap pada GitHub Actions.
              </p>
              <router-link
                to="/tasks"
                class="btn btn-primary px-4 py-2 fw-semibold shadow-sm"
              >
                <i class="bi bi-arrow-right-circle me-2" />Buka Halaman Tugas (API)
              </router-link>
            </div>
            <div class="col-md-4 text-center mt-3 mt-md-0">
              <div class="p-3 bg-light rounded-4 border">
                <i class="bi bi-code-slash display-3 text-primary mb-2" />
                <h6 class="fw-bold mb-1">
                  Arsitektur Decoupled
                </h6>
                <small class="text-muted">Vue 3 SPA &bull; Laravel REST API</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Student Profile & Tech Stack -->
        <div class="row g-4">
          <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 rounded-3">
              <div class="card-header bg-white border-0 pt-3 pb-0">
                <h5 class="fw-bold mb-0 text-primary">
                  <i class="bi bi-person-badge me-2" />Identitas Mahasiswa
                </h5>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span class="text-muted">Nama Lengkap</span>
                    <span class="fw-semibold">Akmal Manggala Putra</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span class="text-muted">NIM</span>
                    <span class="fw-semibold">24/536182/SV/24402</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span class="text-muted">Kelas</span>
                    <span class="badge bg-secondary-subtle text-secondary fw-semibold">PLB2</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span class="text-muted">Dosen Pengampu</span>
                    <span class="fw-semibold">Galih Malela Damaraji, S.Pd., M.Eng.</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 rounded-3">
              <div class="card-header bg-white border-0 pt-3 pb-0">
                <h5 class="fw-bold mb-0 text-success">
                  <i class="bi bi-layers me-2" />Komponen Teknologi
                </h5>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="bi bi-check-circle-fill text-success me-2" />Frontend Core</span>
                    <span class="badge bg-success-subtle text-success">Vue 3 + Vite 6 + Vue Router</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="bi bi-check-circle-fill text-success me-2" />Unit Testing</span>
                    <span class="badge bg-success-subtle text-success">Vitest 2.1 (Pure Logic)</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="bi bi-check-circle-fill text-success me-2" />CI/CD Pipeline</span>
                    <span class="badge bg-success-subtle text-success">GitHub Actions (4 Jobs)</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="bi bi-check-circle-fill text-success me-2" />Backend &amp; API</span>
                    <span class="badge bg-success-subtle text-success">Laravel 11+ RESTful CORS</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeView'
}
</script>
