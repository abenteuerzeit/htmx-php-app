<?php
namespace App\Repositories;

use App\Models\Task;
use SQLite3;

class TaskRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new SQLite3(__DIR__ . '/../../database/tasks.db');
    }

    public function getAll()
    {
        $result = $this->db->query('SELECT * FROM tasks');
        $tasks = [];

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $tasks[] = new Task($row['id'], $row['description']);
        }

        return $tasks;
    }

    public function create($description)
    {
        $stmt = $this->db->prepare('INSERT INTO tasks (description) VALUES (:description)');
        $stmt->bindValue(':description', $description, SQLITE3_TEXT);

        if ($stmt->execute()) {
            return new Task($this->db->lastInsertRowID(), $description);
        }

        return null;
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        return $stmt->execute();
    }
}