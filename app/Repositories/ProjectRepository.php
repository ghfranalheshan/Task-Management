<?php
namespace App\Repositories;
use App\Models\Project;


class ProjectRepository
{
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return Project::all();

    }

    public function save(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return Project::query()->create([
            'name'=>$data['name'],
            'description' => $data['description'],
            'team_id'=>$data['team_id']
            


        ]);
    }

    function get(Project $project): Project
    {
        return $project->with('tasks');
    }

    public function update(array $data, Project $project): Project
    {
        $project->update([
            'name'=>$data['name'],
            'description' => $data['description'],
            'team_id'=>$data['team_id']
  
        ]);
        return $project;

    }

    public function delete(Project $project): Project
    {
        $project->delete();
        return  $project;
    }
}
