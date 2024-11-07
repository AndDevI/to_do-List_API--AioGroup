<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;


 /**
 * @OA\Schema(
 *     schema="TaskRequest",
 *     type="object",
 *     required={"title", "description"},
 *     @OA\Property(property="title", type="string", example="Título da tarefa"),
 *     @OA\Property(property="description", type="string", example="Descrição da tarefa"),
 *     @OA\Property(property="status", type="string", example="não completo")
 * )
 */

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }

    /**
     * @OA\Get(
     *     path="/tasks",
     *     summary="Listar todas as tarefas",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filtrar tarefas por status",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tarefas",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     */
    public function index(Request $request) {
        $tasks = $this->taskService->getAllTasks($request->status);
        return response()->json(['data' => $tasks], 200);
    }

    /**
     * @OA\Post(
     *     path="/tasks",
     *     summary="Criar uma nova tarefa",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tarefa criada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Tarefa criada com sucesso"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function store(TaskRequest $request) {
        $task = $this->taskService->createTask($request->validated());
        return response()->json(['message' => 'Tarefa criada com sucesso', 'data' => $task], 201);
    }

    /**
     * @OA\Put(
     *     path="/tasks/{id}",
     *     summary="Atualizar uma tarefa existente",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da tarefa a ser atualizada",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status da tarefa atualizado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Status da tarefa atualizado"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function update(TaskRequest $request, $id) {
        $task = $this->taskService->updateTask($id, $request->validated());
        return response()->json(['message' => 'Status da tarefa atualizado', 'data' => $task], 200);
    }

    /**
     * @OA\Delete(
     *     path="/tasks/{id}",
     *     summary="Deletar uma tarefa",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da tarefa a ser deletada",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tarefa deletada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Tarefa deletada com sucesso")
     *         )
     *     )
     * )
     */
    public function destroy($id) {
        $this->taskService->deleteTask($id);
        return response()->json(['message' => 'Tarefa deletada com sucesso'], 200);
    }
}
