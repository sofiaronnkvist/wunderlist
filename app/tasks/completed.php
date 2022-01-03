<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we see if a task is completed or not.

if (isset($_POST['delete-list'])) {
    $listId =  $_POST['delete-list'];
    $nullId = null;

    $statement = $database->prepare("UPDATE tasks SET list_id = :list_id WHERE list_id = $listId");
    $statement->bindParam(':list_id', $nullId, PDO::PARAM_NULL);

    $statement->execute();

    $statement = $database->prepare('DELETE FROM lists WHERE id = :id');
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);

    $statement->execute();
}

redirect('/');
