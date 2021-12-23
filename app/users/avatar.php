<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {
    $avatarFile = $_FILES['avatar'];
    $avatarName = date('ymd') . '-' . $avatarFile['name'];

    $path = __DIR__ . '/../../uploads/';
    $destination = $path . $avatarName;

    move_uploaded_file($avatarFile['tmp_name'], $destination);

    $statement  = $database->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['user']['avatar'] = $userAvatar;
}

redirect('/profile.php');
