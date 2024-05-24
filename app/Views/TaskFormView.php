<?php
namespace App\Views;

class TaskFormView
{
    public function render()
    {
        return <<<EOL
        <form id="add-task-form" hx-post="index.php?action=create" hx-target="#task-list" hx-swap="afterbegin">
            <div class="card-body">
                <h3 class="card-title">Add Stuff</h3>
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                            <label for="task-description" class="visually-hidden">Task:</label>
                            <input type="text" id="task-description" name="description" class="form-control" placeholder="Enter task description" required>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-dark btn-block"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </form>
        EOL;
    }
}