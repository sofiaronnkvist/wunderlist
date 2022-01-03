<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new tasks in the database.

if ($_POST['task-list'] === '') {
    $_POST['task-list'] = 'NULL';
}

if (isset($_POST['task-title'], $_POST['task-description'], $_POST['task-deadline'], $_POST['task-list'])) {
    $taskTitle = trim($_POST['task-title']);
    $taskDescription = trim($_POST['task-description']);
    $taskDeadline = $_POST['task-deadline'];
    $createdAt = date("Y-m-d");
    $taskList = $_POST['task-list'];
    $userId = $_SESSION['user']['id'];

    $statement = $database->prepare('INSERT INTO tasks (task_title, task_description, created_at, deadline_at, list_id, user_id) VALUES (:task_title, :task_description, :created_at, :deadline_at, :list_id, :user_id)');
    $statement->bindParam(':task_title', $taskTitle, PDO::PARAM_STR);
    $statement->bindParam(':task_description', $taskDescription, PDO::PARAM_STR);
    $statement->bindParam(':created_at', $createdAt, PDO::PARAM_STR);
    $statement->bindParam(':deadline_at', $taskDeadline, PDO::PARAM_STR);
    $statement->bindValue(':list_id', $taskList, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

    $statement->execute();
}

redirect('/');
