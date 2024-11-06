<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(TaskRequest $request) {
        $task = Task::create($request->validated());
        return response()->json(['message' => 'Tarefa criada com sucesso', 'data' => $task], 201);
    }

    public function index(Request $request) {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->get();

        return response()->json(['data' => $tasks], 200);
    }

    public function show($id) {
        $task = Task::findOrFail($id);

        return response()->json(['data' => $task], 200);
    }

    public function update(TaskRequest $request, $id) {
        $task = Task::findOrFail($id);
        $task->update($request->validated());

        return response()->json(['message' => 'Status da tarefa atualizado', 'data' => $task], 200);
    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Tarefa deletada com sucesso'], 200);
    }
}
