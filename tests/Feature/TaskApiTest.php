<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_fetch_all_tasks_as_json(): void
    {
        Task::create([
            'title' => 'Tugas Praktikum KEPL P4',
            'description' => 'Membuat frontend Vue 3 dan integrasi API',
            'is_completed' => false,
        ]);

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ])
            ->assertJsonFragment([
                'title' => 'Tugas Praktikum KEPL P4',
            ]);
    }

    public function test_can_fetch_tugas_alias_endpoint(): void
    {
        Task::create([
            'title' => 'Tugas Kuliah',
            'description' => 'Mengerjakan laporan praktikum',
            'is_completed' => true,
        ]);

        $response = $this->getJson('/api/tugas');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_can_create_task_via_api(): void
    {
        $payload = [
            'title' => 'Tugas Baru dari API',
            'description' => 'Deskripsi tugas baru',
            'is_completed' => false,
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Tugas Baru dari API',
        ]);
    }
}
