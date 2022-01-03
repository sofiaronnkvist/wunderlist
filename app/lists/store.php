<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new lists in the database.

if (isset($_POST['list-title'])) {
    $listTitle = trim($_POST['list-title']);
    $userId = $_SESSION['user']['id'];

    $statement = $database->prepare('INSERT INTO lists (list_title, user_id) VALUES (:list_title, :user_id)');
    $statement->bindParam(':list_title', $listTitle, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

    $statement->execute();
}

redirect('/');
