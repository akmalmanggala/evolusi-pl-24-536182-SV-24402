<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_tasks_dapat_diakses(): void
    {
        $response = $this->get('/tasks');
        $response->assertStatus(500); // SENGAJA DIGAGALKAN (Aslinya 200)
        $response->assertSee('Manajemen Tugas');
    }

    public function test_dapat_menambahkan_tugas_baru(): void
    {
        $response = $this->post('/tasks', [
            'title' => 'Belajar CI/CD Laravel',
            'description' => 'Membuat pipeline 4 job di GitHub Actions',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'title' => 'Belajar CI/CD Laravel',
        ]);
    }

    public function test_dapat_menghapus_tugas(): void
    {
        $task = Task::create([
            'title' => 'Tugas yang akan dihapus',
            'description' => 'Contoh deskripsi',
        ]);

        $response = $this->delete('/tasks/' . $task->id);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}