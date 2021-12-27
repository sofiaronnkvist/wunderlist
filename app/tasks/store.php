<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new tasks in the database.

if (isset($_POST['task-title'], $_POST['task-description'], $_POST['task-deadline'])) {
    $taskTitle = trim($_POST['task-title']);
    $taskDescription = trim($_POST['task-description']);
    $taskDeadline = $_POST['task-deadline'];
    $createdAt = date("Y-m-d");
    $userId = $_SESSION['user']['id'];

    $statement = $database->prepare('INSERT INTO tasks (task_title, task_description, created_at, deadline_at, user_id) VALUES (:task_title, :task_description, :created_at, :deadline_at, :user_id)');
    $statement->bindParam(':task_title', $taskTitle, PDO::PARAM_STR);
    $statement->bindParam(':task_description', $taskDescription, PDO::PARAM_STR);
}

redirect('/');
