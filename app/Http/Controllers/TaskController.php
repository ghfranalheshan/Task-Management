<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Models\Task;
use App\Models\Project;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    protected TaskService $taskService;

    /**
     * @param TaskService $teamService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->taskService->listData(),Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->taskService->saveData($request->validated()),Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->taskService->getData($task),Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->taskService->updateData($request->validated(), $task),Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->taskService->deleteData($task),Response::HTTP_OK);
    }
    public function assignTask(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->taskService->assignTaskToUser($request->taskId, $request->userId));
}
     public function getMyTask(): \Illuminate\Http\JsonResponse
{
    return response()->json($this->taskService->getMyTask());
}
public function getTaskbyProject(Project $project): \Illuminate\Http\JsonResponse
{
    return response()->json($this->taskService->getTaskbyProject($project));
}
public function setComplete(Task $task): \Illuminate\Http\JsonResponse
{
    return response()->json($this->taskService->setComplete($task));
}
public function getMyTaskByType(Request $request): \Illuminate\Http\JsonResponse
{
    return response()->json($this->taskService->getMyTaskByType($request->type));
}

}

