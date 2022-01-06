<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function isUserLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

// if (isUserLoggedIn());


$_SESSION['messages'][] = [
    'registration' => 'The username or email is already in use.',
    'login' => 'error',
];

function errorMessages()
{
    isset($_SESSION['messages']);
}

// if (errorMessages());

// function checkEmail($database, $email): array
// {
//     $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
//     $statement->bindParam(':email', $email, PDO::PARAM_STR);
//     $statement->execute();

//     $user = $statement->fetch(PDO::FETCH_ASSOC);
//     return $user;
// }

function getListName($database, $taskId): array
{
    $statement = $database->prepare('SELECT list_title FROM lists INNER JOIN tasks ON tasks.list_id = lists.id WHERE tasks.id = :id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->execute();

    $listTitle = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $listTitle;
}


function getLists($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->query("SELECT * FROM lists WHERE user_id = $userId");
    $lists = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $lists;
}

function getTasks($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->query("SELECT * FROM tasks WHERE user_id = $userId");
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

function getTodaysTasks($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->query("SELECT * FROM tasks WHERE user_id = $userId AND deadline_at = DATE()");
    $todaysTasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $todaysTasks;
}

function tasksInList($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->query("SELECT * FROM tasks INNER JOIN lists
    ON tasks.list_id = lists.id WHERE tasks.user_id = $userId");
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

function json_response(array $data = [], int $statusCode = 200): string
{
    http_response_code($statusCode);

    header('Content-Type: application/json');

    return json_encode($data);
}

function isChecked($task): bool
{
    if ($task['completed_at'] != NULL) {
        return true;
    } else {
        return false;
    }
}
