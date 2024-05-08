<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectService 
{
    /**
     * @var ProjectRepository
     */
    protected ProjectRepository $projectRepository;
       /**
     * @param ProjectRepository $PprojectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
  
    public function listData(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->projectRepository->list();
    }
    public function saveData(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return $this->projectRepository->save($data);
    }

    public function getData(Project $project): Project
    {
        return $this->projectRepository->get($project);
    }
    public function updateData(array $data,Project $project): Project
    {
        return $this->projectRepository->update($data,$project);
    }

    public function deleteData(Project $project): Project
    {
        return $this->projectRepository->delete($project);
    }



}
