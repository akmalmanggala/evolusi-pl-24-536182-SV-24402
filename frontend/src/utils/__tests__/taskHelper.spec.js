import { describe, it, expect } from 'vitest'
import {
  formatStatusBadge,
  filterTasks,
  calculateTaskSummary,
  isValidTaskTitle,
  truncateDescription
} from '../taskHelper.js'

describe('taskHelper - Pure Logic Unit Tests', () => {
  it('harus memformat status badge dengan benar sesuai status is_completed', () => {
    const selesai = formatStatusBadge(true)
    expect(selesai.label).toBe('Selesai SALAH')
    expect(selesai.badgeClass).toContain('bg-success')

    const pending = formatStatusBadge(false)
    expect(pending.label).toBe('Belum Selesai')
    expect(pending.badgeClass).toContain('bg-warning')
  })

  it('harus memfilter tugas berdasarkan status completed dan pending', () => {
    const list = [
      { id: 1, title: 'Tugas A', is_completed: true },
      { id: 2, title: 'Tugas B', is_completed: false },
      { id: 3, title: 'Tugas C', is_completed: true }
    ]

    expect(filterTasks(list, 'all')).toHaveLength(3)
    expect(filterTasks(list, 'completed')).toHaveLength(2)
    expect(filterTasks(list, 'pending')).toHaveLength(1)
  })

  it('harus menghitung ringkasan statistik tugas secara akurat', () => {
    const list = [
      { id: 1, is_completed: true },
      { id: 2, is_completed: false },
      { id: 3, is_completed: true },
      { id: 4, is_completed: false }
    ]

    const stats = calculateTaskSummary(list)
    expect(stats.total).toBe(4)
    expect(stats.completed).toBe(2)
    expect(stats.pending).toBe(2)
    expect(stats.completionRate).toBe(50)
  })

  it('harus memvalidasi judul tugas minimal 3 karakter', () => {
    expect(isValidTaskTitle('AB')).toBe(false)
    expect(isValidTaskTitle('   ')).toBe(false)
    expect(isValidTaskTitle('Tugas KEPL')).toBe(true)
  })

  it('harus memotong deskripsi yang terlalu panjang dengan elipsis', () => {
    const longText = 'Ini adalah deskripsi tugas yang sangat panjang melebihi batas lima puluh karakter.'
    const result = truncateDescription(longText, 20)
    expect(result).toBe('Ini adalah deskripsi...')
    expect(truncateDescription('Pendek', 20)).toBe('Pendek')
  })
})
