<?php
namespace App\Repositories;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendReminderEmailJob;


class TaskRepository
{
    protected $expirationTime = 60;
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return Task::all();

    }

    public function save(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        
       $createdTask= Task::query()->create([
            'title' => $data['title'],
            'type' => $data['type'],
            'description' => $data['description'],
            'due_date' => $data['due_date'],
            'project_id' => $data['project_id']?? null,
            'user_id' => $data['user_id'] ?? null,
        
        ]);
if($createdTask->user_id)
{
      $userEmail=User::find($data['user_id'])->get()->value('email');
   
            // Dispatch the job for sending a reminder email
    dispatch(new SendReminderEmailJob($createdTask->id,'new Task added for you',$userEmail));
}
        $cacheKey = 'task:' . $createdTask->id;
        Cache::forget($cacheKey);
        return $createdTask;
    }

    function get(Task $task)
    {
       
        $cacheKey = 'task:' . $task->id; 
        if (Cache::has($cacheKey)) {
           
            // Cache key exists, fetch the value
            $cachedData = Cache::get($cacheKey);
            return $cachedData;
            // ...
        } else {
            // Cache key doesn't exist, fetch data from the database
            $task = Task::find($task->id);
            $taskWithDetails= $task->where('id',$task->id)->with('attachments')->get();
            // Store the fetched data in the cache
            Cache::put($cacheKey, $taskWithDetails, $this->expirationTime);   
           return  $taskWithDetails; 
}
    }
    public function update(array $data, Task $task): Task
    {
        $task->update([
            'title' => $data['title'] ??$task->title,
            'type' => $data['type']??$task->type,
            'description' => $data['description'] ??$task->description,
            'due_date' => $data['due_date']??$task->due_date,
            'project_id' => $data['project_id']??$task->project_id,
            'user_id'=>$data['user_id']??$task->project_id,
            
        ]);
   
        return $task;

    }
//delete taskt
    public function delete(Task  $task): Task
    {
        $task->delete();
        return  $task;
    }
   //if the task creat without put user this to make it 
    public function assignTaskToUser($taskId, $userId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->user_id = $userId;
            $task->save();
            $userEmail=User::find($task->user_id)->get()->value('email');
            // Dispatch the job for sending a reminder email
    dispatch(new SendReminderEmailJob($task->id,'new Task assigned you', $userEmail));
        }
        return $task;

}
//the user tasks
public function getMyTask()
{
    $tasks = Task::where('user_id',Auth::id())->get();
    foreach($tasks as $task)
    {
    $cacheKey = 'task:' . $task->id; 
    if (Cache::has($cacheKey)) {
       
        // Cache key exists, fetch the value
        $cachedData = Cache::get($cacheKey);
        return $cachedData;
        // ...
    } else {
        // Cache key doesn't exist, fetch data from the database
        $task = Task::find($task->id);
        // Store the fetched data in the cache
        Cache::put($cacheKey,$task, $this->expirationTime);   
       return  $task; 
    }
}
    
}
//to get tasks which in one project
public function getTaskbyProject($project)
{
    $tasks=$project->tasks()->get();
    return $tasks;
}
public function setComplete($task)
{
    $task->update(
        [
              'completed' => true
        ]);
        return 'set successfully';

}
public function getMyTaskByType($type)
{
    
    $tasks = Task::where('user_id',Auth::id())->where('type',$type)->get();
     foreach($tasks as $task)
    {
    $cacheKey = 'task:' . $task->id; 
    if (Cache::has($cacheKey)) {
       
        // Cache key exists, fetch the value
        $cachedData = Cache::get($cacheKey);
        return $cachedData;
        // ...
    } else {
        // Cache key doesn't exist, fetch data from the database
        $task = Task::find($task->id);
        // Store the fetched data in the cache
        Cache::put($cacheKey,$task, $this->expirationTime);   
       return  $task; 
    }

}
}
}