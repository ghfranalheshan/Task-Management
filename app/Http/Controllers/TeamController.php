<?php

namespace App\Http\Controllers;
use App\Services\TeamService;
use App\Models\Team;
use App\Http\Requests\Team\StoreTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;



class TeamController extends Controller
{
    protected TeamService $teamService;

    /**
     * @param TeamService $teamService
     */
    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->teamService->listData(),Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->teamService->saveData($request->validated()),Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->teamService->getData( $team),Response::HTTP_ok);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->teamService->updateData($request->validated(), $team),Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->teamService->deleteData($team),Response::HTTP_OK);
    }
    public function addUserToTeam(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->teamService->addUserToTeam($request),Response::HTTP_OK);
    }
    public function getMyTeam(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->teamService->getMyTeam(),Response::HTTP_OK);
    }
    public function getMyTeamMembers(Team $team): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->teamService->getMyTeamMembers($team),Response::HTTP_OK);
    }

}

