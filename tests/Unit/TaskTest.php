<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_has_default_status() {
        $task = Task::factory()->create();
        $this->assertEquals('não completa', $task->status);
    }
}
