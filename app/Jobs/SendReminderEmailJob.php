<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Task;
use App\Mail\ReminderMail;

class SendReminderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $taskId; 
    private $recipient; 
    private $body;

    /**
     * Create a new job instance.
     */
    public function __construct($taskId, $body , $recipient)
    {
        $this->taskId = $taskId;
        $this->body = $body;
        $this->recipient = $recipient;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Retrieve the task details based on taskId
        $task = Task::find($this->taskId);

        // Create and send the reminder email
        $email = new ReminderMail($task->title,$this->body);
        Mail::to($this->recipient)->send($email);
    }
}