<?php

// app/Services/TaskService.php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks($status = null) {
        return $this->taskRepository->getAll($status);
    }

    public function createTask(array $data) {
        return $this->taskRepository->create($data);
    }

    public function updateTask($id, array $data) {
        return $this->taskRepository->update($id, $data);
    }

    public function deleteTask($id) {
        return $this->taskRepository->delete($id);
    }
}

