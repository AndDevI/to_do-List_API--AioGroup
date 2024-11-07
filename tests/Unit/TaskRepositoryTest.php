<?php

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
        $this->taskRepository = new TaskRepository();
    }

    public function test_it_can_create_task() {
        $data = [
            'title' => 'New Task',
            'description' => 'Task Description',
            'status' => 'não completa',
        ];

        $task = $this->taskRepository->create($data);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals($data['title'], $task->title);
    }

    public function test_it_can_find_task() {
        $task = Task::factory()->create();
        $foundTask = $this->taskRepository->find($task->id);

        $this->assertEquals($task->id, $foundTask->id);
    }

    public function test_it_can_update_task() {
        $task = Task::factory()->create();
        $data = ['status' => 'completa'];

        $updatedTask = $this->taskRepository->update($task, $data);

        $this->assertEquals($data['status'], $updatedTask->status);
    }

    public function test_it_can_delete_task() {
        $task = Task::factory()->create();
        $this->taskRepository->delete($task);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
