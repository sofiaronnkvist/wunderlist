<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we see if a task is completed or not.

if (isset($_POST['completed'])) {
    $completedAt =  $_POST['completed'];

    $statement = $database->prepare('UPDATE tasks SET completed_at = :completed_at WHERE id = :id');
    $statement->bindParam(':completed_at', $completedAt, PDO::PARAM_STR);

    $statement->execute();
} elseif (!isset($_POST['completed'])) {
    $completedAt =  null;

    $statement = $database->prepare('UPDATE tasks SET completed_at = :completed_at WHERE id = :id');
    $statement->bindParam(':completed_at', $completedAt, PDO::PARAM_STR);

    $statement->execute();
}

redirect('/');
