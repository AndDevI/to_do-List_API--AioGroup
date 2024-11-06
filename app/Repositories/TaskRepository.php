<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function getAll($status = null) {
        $query = Task::query();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }

    public function find($id) {
        return Task::findOrFail($id);
    }

    public function create(array $data) {
        return Task::create($data);
    }

    public function update(Task $task, array $data) {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task) {
        $task->delete();
    }
}
