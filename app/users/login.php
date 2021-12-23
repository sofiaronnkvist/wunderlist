<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we login users.

if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);

    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // checkEmail($database, $email);
    //Hur får jag funktionen att ge tillbaka $user = true så att detta funkar?????????

    if (!$user) {
        redirect('/login.php');
        // $_SESSION['messages']['login'];
    }

    if (password_verify($_POST['password'], $user['password'])) {
        unset($user['password']);
        $_SESSION['user'] = $user;
    }
}

redirect('/');
