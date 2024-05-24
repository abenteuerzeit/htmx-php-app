<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\TaskController;
use App\Views\TaskFormView;

$taskController = new TaskController();

if (isset($_GET['action']) && in_array($_GET['action'], ['create', 'delete'])) {
    $taskController->handleRequest();
    exit;
}

require_once __DIR__ . '/template.php';
?>
