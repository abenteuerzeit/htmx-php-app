<?php
namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Views\TaskView;

class TaskController
{
    private $taskRepository;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    public function create()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['description'])) {
                $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');

                $task = $this->taskRepository->create($description);

                if ($task) {
                    $taskView = new TaskView($task);
                    echo $taskView->render();
                } else {
                    throw new \Exception('Failed to create task.');
                }
            } else {
                throw new \Exception('Task description cannot be empty.');
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
        }
    }

    public function delete()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
                $id = intval($_GET['id']);

                if ($id !== false) {
                    $success = $this->taskRepository->delete($id);

                    if ($success) {
                        http_response_code(200);
                        echo '';
                    } else {
                        throw new \Exception('Failed to delete task.');
                    }
                } else {
                    throw new \Exception('Invalid task ID.');
                }
            } else {
                throw new \Exception('Invalid request.');
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
        }
    }

    public function list()
    {
        $tasks = $this->taskRepository->getAll();

        $output = '';
        foreach ($tasks as $task) {
            $taskView = new TaskView($task);
            $output .= $taskView->render();
        }

        return $output;
    }

    public function handleRequest()
    {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            switch ($action) {
                case 'create':
                    $this->create();
                    break;
                case 'delete':
                    $this->delete();
                    break;
                default:
                    echo $this->list();
                    break;
            }
        } else {
            echo $this->list();
        }
    }
}
?>
