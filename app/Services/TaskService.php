<?php

namespace App\Services;

use App\Models\User;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    /**
     * @var TaskRepository
     */
    protected TaskRepository $taskRepository;
       /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    public function listData(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->taskRepository->list();
    }
    public function saveData(array $data):  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return $this->taskRepository->save($data);
    }

    public function getData(Task $task)
    {
        return $this->taskRepository->get($task);
    }
    public function updateData(array $data,Task $task): Task
    {
        return $this->taskRepository->update($data,$task);
    }

    public function deleteData(Task $task): Task
    {
        return $this->taskRepository->delete($task);
    }
    public function assignTaskToUser($taskId, $userId)
    {
        return $this->taskRepository->assignTaskToUser($taskId, $userId);
    }
    public function getMyTask()
    {
        return $this->taskRepository->getMyTask();
    }
    public function getTaskbyProject($project)
    {
        return $this->taskRepository->getTaskbyProject( $project);
    }
    public function setComplete($task)
    {
        return $this->taskRepository->setComplete($task);
    }
    public function getMyTaskByType($type)
    {
        return $this->taskRepository->getMyTaskByType($type);
    }
   



}
