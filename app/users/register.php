<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statement = $database->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    echo "\nPDOStatement::errorCode(): ";
    print $statement->errorCode();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // if (!$user) {
    //     redirect('/login.php');
    // }

    // if (password_verify($_POST['password'], $user['password'])) {
    //     unset($user['password']);
    //     $_SESSION['user'] = $user;
    // }
}

redirect('/');
