<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete everything about a user.

if (isset($_POST['delete-user'])) {
    $userId = $_SESSION['user']['id'];

    $statement = $database->prepare('DELETE FROM tasks WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

    $statement->execute();

    $statement = $database->prepare('DELETE FROM lists WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

    $statement->execute();

    $statement = $database->prepare('DELETE FROM users WHERE id = :id');
    $statement->bindParam(':id', $userId, PDO::PARAM_INT);

    $statement->execute();

    unset($_SESSION['user']);
}

redirect('/');
