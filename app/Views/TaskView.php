<?php
namespace App\Views;

use App\Models\Task;

class TaskView
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function render()
    {
        $taskId = $this->task->getId();
        $description = htmlspecialchars($this->task->getDescription());

        return <<<EOL
        <li class="card task-item" id="task-$taskId">
            <article class="card-body">
                <div class="row">
                    <div class="col-10">
                        <p>$description</p>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-danger btn-sm" hx-delete="index.php?action=delete&id=$taskId" hx-target="closest li" hx-swap="outerHTML">
                            <span class="visually-hidden">Delete task</span>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </article>
        </li>
        EOL;
    }
}