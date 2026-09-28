/**
 * Format status badge based on completion boolean
 */
export function formatStatusBadge(isCompleted) {
  if (isCompleted === true || isCompleted === 1 || isCompleted === '1') {
    return {
      label: 'Selesai',
      badgeClass: 'bg-success text-white'
    }
  }
  return {
    label: 'Belum Selesai',
    badgeClass: 'bg-warning text-dark'
  }
}

/**
 * Filter tasks array by status ('all', 'completed', 'pending')
 */
export function filterTasks(tasks, filterStatus = 'all') {
  if (!Array.isArray(tasks)) return []
  if (filterStatus === 'completed') {
    return tasks.filter(t => t.is_completed === true || t.is_completed === 1 || t.is_completed === '1')
  }
  if (filterStatus === 'pending') {
    return tasks.filter(t => !t.is_completed || t.is_completed === 0 || t.is_completed === '0')
  }
  return tasks
}

/**
 * Calculate statistical summary of tasks
 */
export function calculateTaskSummary(tasks) {
  if (!Array.isArray(tasks)) {
    return { total: 0, completed: 0, pending: 0, completionRate: 0 }
  }
  const total = tasks.length
  const completed = tasks.filter(t => t.is_completed === true || t.is_completed === 1 || t.is_completed === '1').length
  const pending = total - completed
  const completionRate = total > 0 ? Math.round((completed / total) * 100) : 0

  return { total, completed, pending, completionRate }
}

/**
 * Validates task title
 */
export function isValidTaskTitle(title) {
  if (!title || typeof title !== 'string') return false
  return title.trim().length >= 3
}

/**
 * Truncates task description safely
 */
export function truncateDescription(text, maxLength = 50) {
  if (!text || typeof text !== 'string') return ''
  if (text.length <= maxLength) return text
  return text.substring(0, maxLength) + '...'
}
