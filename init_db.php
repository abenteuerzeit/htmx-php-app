<?php
$db = new SQLite3(__DIR__ . '/database/tasks.db');

$db->exec("CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY,
    description TEXT NOT NULL
)");

echo "Database and table created successfully.";
