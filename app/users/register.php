<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    if (strlen($_POST['password']) < 16) {
        $_SESSION['errors'][] = 'The password needs to be 16 characters or longer.';
        redirect('/register.php');
    }

    $username = trim($_POST['username']);
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $statement = $database->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
    } catch (Exception $e) {
        $_SESSION['errors'][] = 'The username or email already exists.';
        redirect('/register.php');
    }

    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST['password'], $user['password'])) {
        unset($user['password']);
        $_SESSION['user'] = $user;
    }
}

redirect('/');
