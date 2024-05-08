<?php

namespace App\Services;

use App\Models\Team;
use App\Repositories\TeamRepository;

class TeamService
{
    /**
     * @var TeamRepository
     */
    protected TeamRepository $teamRepository;
       /**
     * @param TeamRepository $teamSRepository
     */
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }
    public function listData(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->teamRepository->list();
    }
    public function saveData(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return $this->teamRepository->save($data);
    }

    public function getData(Team $Team): Team
    {
        return $this->teamRepository->get($Team);
    }
    public function updateData(array $data,Team $team): Team
    {
        return $this->teamRepository->update($data,$team);
    }

    public function deleteData(Team $team): Team
    {
        return $this->teamRepository->delete($team);
    }
    public function addUserToTeam($request)
    {
        return $this->teamRepository->addUserToTeam($request);
    }
    public function getMyTeam()
    {
        return $this->teamRepository->getMyTeam();
    }
    public function getMyTeamMembers($team)
    {
        return $this->teamRepository->getMyTeamMembers($team);
    }

}
