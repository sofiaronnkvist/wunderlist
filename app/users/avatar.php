<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {
    $avatarFile = $_FILES['avatar'];
    $avatarName = date('ymd') . '-' . ($avatarFile['name']);

    $path = __DIR__ . '/../../uploads/';
    $destination = $path . $avatarName;

    move_uploaded_file($avatarFile['tmp_name'], $destination);

    if (!in_array($avatarFile['type'], ['image/jpeg', 'image/png'])) {
        $_SESSION['errors'][] = "This file type is not allowed.";
        redirect('/profile.php');
    }

    if ($avatarFile['size'] >= 20000000) {
        $_SESSION['errors'][] = "This file is to large.";
        redirect('/profile.php');
    }

    $statement  = $database->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['user']['avatar'] = $avatarName;
}

redirect('/profile.php');
