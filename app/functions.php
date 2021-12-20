<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function isUserLoggedIn()
{
    $loggedInUser = isset($_SESSION['user']);
    return $loggedInUser;
}

// if (isUserLoggedIn());


$_SESSION['messages'][] = [
    'registration' => 'The username or email is already in use.',
    'type' => 'error',
];

function errorMessages()
{
    isset($_SESSION['messages']);
}

// if (errorMessages());

// function checkEmail($database, $email)
// {
//     $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
//     $statement->bindParam(':email', $email, PDO::PARAM_STR);
//     $statement->execute();

//     $user = $statement->fetch(PDO::FETCH_ASSOC);
//     return $user;
// }
