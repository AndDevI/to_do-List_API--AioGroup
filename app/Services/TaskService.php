<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\Http\Requests\TaskRequest;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks($status = null){
        return $this->taskRepository->getAll($status);
    }

    public function createTask(TaskRequest $request) {
        $data = $request->validated();

        return $this->taskRepository->create($data);
    }
 
    public function updateTask($id, TaskRequest $request) {
        $task = $this->taskRepository->find($id);
        $data = $request->validated();

        return $this->taskRepository->update($task, $data);
    }

    public function deleteTask($id) {
        $task = $this->taskRepository->find($id);
        $this->taskRepository->delete($task);
    }
}
