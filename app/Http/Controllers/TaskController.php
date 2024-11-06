<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:completa,não completa',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

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

    public function update(Request $request, $id) {
        $task = Task::findOrFail($id);

        $request->validate([
            'status' => 'required|in:completa,não completa',
        ]);

        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Status da tarefa atualizado', 'data' => $task], 200);
    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Tarefa deletada com sucesso'], 200);
    }
}
