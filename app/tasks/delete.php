<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete tasks in the database.

if (isset($_POST['delete-task'])) {
    $taskId =  $_POST['delete-task'];

    $statement = $database->prepare('DELETE FROM tasks WHERE id = :id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);

    $statement->execute();
}

redirect('/');
