<template>
  <div class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
      <div class="container">
        <router-link
          class="navbar-brand fw-bold"
          to="/"
        >
          <i class="bi bi-box-seam me-2" />KEPL P4 - Evolusi PL
        </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon" />
        </button>
        <div
          id="navbarNav"
          class="collapse navbar-collapse"
        >
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active fw-semibold"
                to="/"
              >
                <i class="bi bi-house-door me-1" />Beranda
              </router-link>
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link"
                active-class="active fw-semibold"
                to="/tasks"
              >
                <i class="bi bi-check2-square me-1" />Daftar Tugas
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="flex-grow-1 py-4">
      <router-view />
    </main>

    <footer class="bg-white border-top py-3 text-center text-muted small mt-auto">
      <div class="container">
        <p class="mb-0">
          <strong>Akmal Manggala Putra</strong> (24/536182/SV/24402) &bull; Kelas PLB2 &bull; Praktikum KEPL Pertemuan 4
        </p>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>
