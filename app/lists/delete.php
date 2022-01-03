<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete lists in the database.

if (isset($_POST['delete-list'])) {
    $listId =  $_POST['delete-list'];

    $statement = $database->prepare('DELETE FROM lists WHERE id = :id');
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);

    $statement->execute();
}

redirect('/');
