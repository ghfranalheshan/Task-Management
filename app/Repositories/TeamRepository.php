<?php
namespace App\Repositories;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TeamRepository
{
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return Team::all();

    }

    public function save(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return Team::query()->create([
            'name'=>$data['name'],
            'description' => $data['description'],
            


        ]);
    }

    function get(Team $team): Team
    {
        return $team->with('users');
    }

    public function update(array $data, Team $team): Team
    {
        $team->update([
            'name'=>$data['name'],
            'description' => $data['description'],
  
        ]);
        return $team;

    }

    public function delete(Team $team): Team
    {
        $team->delete();
        return  $team;
    }
    public function addUserToTeam($request)
    {
        // Find the team and user by their IDs
        $team = Team::find($request->teamId);
        $user = User::find($request->userId);

        // Check if both the team and user exist
        if ($team && $user) {
            // Attach the user to the team using the pivot table
            $team->users()->attach($user->id);
            return 'user added successfully';
        } else {
            // Handle the case where either the team or user does not exist
            // This could involve throwing an exception or logging an error
            throw new \Exception("Team or user not found.");
        }

}
public function getMyTeam()
{
    $user=Auth::user();
    return $user->teams()->get();
}
public function getMyTeamMembers($team)
{
    $members=$team->users()->get();
    return  $members;

}

}
