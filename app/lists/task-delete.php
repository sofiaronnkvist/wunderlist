<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we remove tasks from a list in the database.

if (isset($_POST['delete-task-list'])) {
    $listId =  $_POST['delete-task-list'];
    $nullId = null;

    $statement = $database->prepare("UPDATE tasks SET list_id = :list_id WHERE list_id = $listId");
    $statement->bindParam(':list_id', $nullId, PDO::PARAM_NULL);

    $statement->execute();
}

redirect('/');
