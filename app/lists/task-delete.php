<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we remove tasks from a list in the database.

if (isset($_POST['id'])) {
    $taskId =  $_POST['id'];
    $nullId = null;

    $statement = $database->prepare("UPDATE tasks SET list_id = null WHERE id = :id");
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);

    $statement->execute();
}

redirect('/');
