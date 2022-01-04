<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we see if a task is uncompleted.

if (isset($_POST['completed'])) {
    $completedAt =  null;
    $taskId = 'Placeholder';

    $statement = $database->prepare('UPDATE tasks SET completed_at = :completed_at WHERE id = :id');
    $statement->bindParam(':completed_at', $completedAt, PDO::PARAM_NULL);
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);

    $statement->execute();
}

// redirect('/');
