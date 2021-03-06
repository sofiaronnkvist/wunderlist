<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we see if a task is uncompleted.

if (isset($_POST['completed'])) {
    $taskId = $_POST['completed'];

    $statement = $database->prepare('UPDATE tasks SET completed_at = NULL WHERE id = :id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);

    $statement->execute();
}
