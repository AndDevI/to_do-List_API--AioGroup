<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }

    public function index(Request $request) {
        $tasks = $this->taskService->getAllTasks($request->status);
        return response()->json(['data' => $tasks], 200);
    }

    public function store(TaskRequest $request) {
        $task = $this->taskService->createTask($request);
        return response()->json(['message' => 'Tarefa criada com sucesso', 'data' => $task], 201);
    }

    public function update(TaskRequest $request, $id) {
        $task = $this->taskService->updateTask($id, $request);
        return response()->json(['message' => 'Status da tarefa atualizado', 'data' => $task], 200);
    }

    public function destroy($id) {
        $this->taskService->deleteTask($id);
        return response()->json(['message' => 'Tarefa deletada com sucesso'], 200);
    }
}
