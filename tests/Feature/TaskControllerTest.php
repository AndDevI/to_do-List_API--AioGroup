<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task() {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Nova Tarefa',
            'description' => 'Descrição da tarefa',
            'status' => 'não completa',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'data' => ['id', 'title', 'description', 'status']]);
    }

    public function test_can_list_tasks() {
        Task::factory()->count(3)->create();
        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'title', 'description', 'status']]]);
    }

    public function test_can_update_task_status() {
        $task = Task::factory()->create(['status' => 'não completa']);
        $response = $this->putJson("/api/tasks/{$task->id}", ['status' => 'completa']);
        $response->assertStatus(200)
            ->assertJsonFragment(['status' => 'completa']);
    }

    public function test_can_delete_task() {
        $task = Task::factory()->create();
        $response = $this->deleteJson("/api/tasks/{$task->id}");
        $response->assertStatus(200)
            ->assertJson(['message' => 'Tarefa deletada com sucesso']);
    }
}
