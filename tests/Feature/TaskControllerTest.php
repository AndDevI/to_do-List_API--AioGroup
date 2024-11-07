<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_task() {
        $data = [
            'title' => 'Teste Task',
            'description' => 'Teste Descrição',
            'status' => 'não completa',
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Tarefa criada com sucesso']);
        $this->assertDatabaseHas('tasks', ['title' => 'Teste Task']);
    }

    public function test_it_fetches_tasks() {
        Task::factory()->count(5)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'title', 'status']]]);
    }

    public function test_it_updates_task_status() {
        $task = Task::factory()->create(['status' => 'não completa']);

        $data = [
            'title' => 'Teste Task 2',
            'status' => 'completa'
        ];
        $response = $this->putJson("/api/tasks/{$task->id}", $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Status da tarefa atualizado']);
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'status' => 'completa']);
    }

    public function test_it_deletes_task() {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Tarefa deletada com sucesso']);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
