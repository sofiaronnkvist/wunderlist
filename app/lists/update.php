<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update lists in the database.

if (isset($_POST['update-list'], $_POST['list-title'])) {
    $listTitle = trim($_POST['list-title']);
    $listId = $_POST['update-list'];

    $statement = $database->prepare('UPDATE lists SET list_title = :list_title WHERE id = :id');
    $statement->bindParam(':list_title', $listTitle, PDO::PARAM_STR);
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);

    $statement->execute();
}

redirect('/');
