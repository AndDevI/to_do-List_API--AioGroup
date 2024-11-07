<?php

namespace Tests\Unit\Services;

use App\Models\Task;
use App\Services\TaskService;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    private $taskService;
    private $taskRepository;

    protected function setUp(): void {
        parent::setUp();
        $this->taskRepository = app(TaskRepository::class);
        $this->taskService = new TaskService($this->taskRepository);
    }

    public function testGetAllTasks() {
        $status = 'não completa';
        $this->taskRepository->create(['title' => 'Tarefa 1', 'status' => $status]);
        $this->taskRepository->create(['title' => 'Tarefa 2', 'status' => $status]);
        $this->taskRepository->create(['title' => 'Tarefa 3', 'status' => 'completa']);

        $tasks = $this->taskService->getAllTasks($status);
        $this->assertCount(2, $tasks);
        $this->assertEquals('Tarefa 1', $tasks[0]->title);
        $this->assertEquals('Tarefa 2', $tasks[1]->title);
    }

    public function testCreateTask() {
        $dadosValidos = [
            'title' => 'Nova Tarefa',
            'description' => 'Esta é uma nova tarefa',
            'status' => 'não completa'
        ];

        $task = $this->taskService->createTask($dadosValidos); 
        $this->assertEquals('Nova Tarefa', $task->title);
        $this->assertEquals('Esta é uma nova tarefa', $task->description);
        $this->assertEquals('não completa', $task->status);
    }

    public function testUpdateTask() {
        $task = $this->taskRepository->create(['title' => 'Tarefa Antiga', 'description' => 'Esta é uma tarefa antiga', 'status' => 'não completa']);

        $dadosValidos = [
            'title' => 'Tarefa Atualizada',
            'description' => 'Esta é uma tarefa atualizada',
            'status' => 'completa'
        ];

        $tarefaAtualizada = $this->taskService->updateTask($task->id, $dadosValidos); 
        $this->assertEquals('Tarefa Atualizada', $tarefaAtualizada->title);
        $this->assertEquals('Esta é uma tarefa atualizada', $tarefaAtualizada->description);
        $this->assertEquals('completa', $tarefaAtualizada->status);
    }

    public function testDeleteTask() {
        $task = Task::factory()->create(['title' => 'Tarefa a ser Excluída']);

        $resultado = $this->taskService->deleteTask($task->id);

        $this->assertTrue($resultado);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
