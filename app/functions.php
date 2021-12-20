<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function isUserLoggedIn()
{
    if (isset($_SESSION['user']));
}

// if (isUserLoggedIn());


$_SESSION['messages'][] = [
    'registration' => 'The username or email is already in use.',
    'type' => 'error',
];

function errorMessages()
{
    if (isset($_SESSION['messages']));
}

// if (errorMessages());
