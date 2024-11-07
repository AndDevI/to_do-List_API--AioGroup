<?php

// tests/Unit/TaskRepositoryTest.php
namespace Tests\Unit;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $taskRepository;

    protected function setUp(): void {
        parent::setUp();
        $this->taskRepository = app(TaskRepository::class);
    }

    public function testUpdateTask() {
        $task = Task::factory()->create(['title' => 'Tarefa Original', 'status' => 'não completa']);

        $data = ['title' => 'Tarefa Atualizada', 'status' => 'completa'];
        $updatedTask = $this->taskRepository->update($task->id, $data);

        $this->assertEquals('Tarefa Atualizada', $updatedTask->title);
        $this->assertEquals('completa', $updatedTask->status);
    }

    public function testDeleteTask() {
        $task = Task::factory()->create(['title' => 'Tarefa a ser Excluída']);

        $this->taskRepository->delete($task->id);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
