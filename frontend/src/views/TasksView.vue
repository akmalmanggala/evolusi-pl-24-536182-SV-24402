<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h3 class="fw-bold mb-1">
              Daftar Tugas Praktikum
            </h3>
            <p class="text-muted small mb-0">
              Data diambil secara asinkron dari REST API Laravel: <code>{{ apiUrl }}/tasks</code>
            </p>
          </div>
          <button
            class="btn btn-outline-primary btn-sm"
            :disabled="loading"
            @click="fetchTasks"
          >
            <i
              class="bi bi-arrow-clockwise me-1"
              :class="{ 'spin': loading }"
            />Refresh Data
          </button>
        </div>

        <!-- Metric Cards -->
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-white rounded-3 p-3">
              <div class="d-flex align-items-center">
                <div class="p-3 bg-primary-subtle text-primary rounded-3 me-3">
                  <i class="bi bi-list-task fs-4" />
                </div>
                <div>
                  <small class="text-muted">Total Tugas</small>
                  <h4 class="fw-bold mb-0">
                    {{ summary.total }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-white rounded-3 p-3">
              <div class="d-flex align-items-center">
                <div class="p-3 bg-success-subtle text-success rounded-3 me-3">
                  <i class="bi bi-check2-circle fs-4" />
                </div>
                <div>
                  <small class="text-muted">Tugas Selesai</small>
                  <h4 class="fw-bold mb-0">
                    {{ summary.completed }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-white rounded-3 p-3">
              <div class="d-flex align-items-center">
                <div class="p-3 bg-warning-subtle text-warning rounded-3 me-3">
                  <i class="bi bi-clock-history fs-4" />
                </div>
                <div>
                  <small class="text-muted">Belum Selesai</small>
                  <h4 class="fw-bold mb-0">
                    {{ summary.pending }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filter Controls -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
          <div class="card-body d-flex justify-content-between align-items-center py-2">
            <span class="text-muted small">Filter Tampilan:</span>
            <div class="btn-group btn-group-sm">
              <button
                class="btn"
                :class="currentFilter === 'all' ? 'btn-primary' : 'btn-outline-secondary'"
                @click="currentFilter = 'all'"
              >
                Semua ({{ summary.total }})
              </button>
              <button
                class="btn"
                :class="currentFilter === 'pending' ? 'btn-primary' : 'btn-outline-secondary'"
                @click="currentFilter = 'pending'"
              >
                Belum Selesai ({{ summary.pending }})
              </button>
              <button
                class="btn"
                :class="currentFilter === 'completed' ? 'btn-primary' : 'btn-outline-secondary'"
                @click="currentFilter = 'completed'"
              >
                Selesai ({{ summary.completed }})
              </button>
            </div>
          </div>
        </div>

        <!-- Tasks Table -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
          <div
            v-if="loading"
            class="text-center py-5"
          >
            <div
              class="spinner-border text-primary mb-3"
              role="status"
            />
            <p class="text-muted small mb-0">
              Memuat data dari API Laravel...
            </p>
          </div>

          <div
            v-else-if="error"
            class="alert alert-danger m-4"
          >
            <i class="bi bi-exclamation-triangle-fill me-2" />
            <strong>Gagal memuat data API:</strong> {{ error }}
          </div>

          <div
            v-else-if="filteredTasks.length === 0"
            class="text-center py-5 text-muted"
          >
            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary" />
            <p class="mb-0">
              Tidak ada data tugas yang sesuai dengan filter.
            </p>
          </div>

          <div
            v-else
            class="table-responsive"
          >
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light small text-uppercase text-muted">
                <tr>
                  <th
                    style="width: 60px;"
                    class="text-center"
                  >
                    #
                  </th>
                  <th>Judul Tugas</th>
                  <th>Deskripsi</th>
                  <th style="width: 150px;">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(task, index) in filteredTasks"
                  :key="task.id || index"
                >
                  <td class="text-center text-muted fw-bold">
                    {{ index + 1 }}
                  </td>
                  <td class="fw-semibold text-dark">
                    {{ task.title }}
                  </td>
                  <td class="text-secondary small">
                    {{ task.description || '-' }}
                  </td>
                  <td>
                    <span :class="['badge rounded-pill px-3 py-2', getStatusBadge(task.is_completed).badgeClass]">
                      {{ getStatusBadge(task.is_completed).label }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { formatStatusBadge, filterTasks, calculateTaskSummary } from '../utils/taskHelper.js'

export default {
  name: 'TasksView',
  data() {
    return {
      tasks: [],
      loading: true,
      error: null,
      currentFilter: 'all',
      apiUrl: import.meta.env.VITE_API_URL || 'http://localhost:8000/api'
    }
  },
  computed: {
    filteredTasks() {
      return filterTasks(this.tasks, this.currentFilter)
    },
    summary() {
      return calculateTaskSummary(this.tasks)
    }
  },
  mounted() {
    this.fetchTasks()
  },
  methods: {
    getStatusBadge(isCompleted) {
      return formatStatusBadge(isCompleted)
    },
    async fetchTasks() {
      this.loading = true
      this.error = null
      try {
        const response = await fetch(`${this.apiUrl}/tasks`)
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`)
        }
        const result = await response.json()
        this.tasks = result.data || []
      } catch (err) {
        this.error = err.message
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped>
.spin {
  animation: spin 1s linear infinite;
}
@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
</style>
