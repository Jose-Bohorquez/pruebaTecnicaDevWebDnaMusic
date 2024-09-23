<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->view('emails.task_notification') // Vista que crearemos en el siguiente paso
                    ->with([
                        'taskTitle' => $this->task->title,
                        'taskUrl' => url('/tasks/' . $this->task->id),
                    ]);
    }
}
