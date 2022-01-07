<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update tasks in the database.


if (isset($_POST['update-task'], $_POST['task-title'], $_POST['task-description'], $_POST['task-deadline'], $_POST['task-list'])) {

    $taskTitle = trim($_POST['task-title']);
    $taskDescription = trim($_POST['task-description']);
    $taskDeadline = $_POST['task-deadline'];
    $taskList = $_POST['task-list'];
    $userId = $_SESSION['user']['id'];
    $taskId =  $_POST['update-task'];

    if ($taskList === '') {
        $taskList = NULL;
    }

    $statement = $database->prepare('UPDATE tasks SET task_title = :task_title, task_description = :task_description, deadline_at = :deadline_at, list_id = :list_id, user_id = :user_id WHERE id = :id');
    $statement->bindParam(':task_title', $taskTitle, PDO::PARAM_STR);
    $statement->bindParam(':task_description', $taskDescription, PDO::PARAM_STR);
    $statement->bindParam(':deadline_at', $taskDeadline, PDO::PARAM_STR);
    $statement->bindValue(':list_id', $taskList, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);

    $statement->execute();
}

redirect('/');
