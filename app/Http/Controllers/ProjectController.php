<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Models\Project;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use Symfony\Component\HttpFoundation\Response;
class ProjectController extends Controller
{
    protected ProjectService $projectService;

    /**
     * @param  ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->projectService->listData(),Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->projectService->saveData($request->validated()),Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->projectService->getData($project),Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->projectService->updateData($request->validated(), $project),Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->projectService->deleteData($project),Response::HTTP_OK);
    }
}
