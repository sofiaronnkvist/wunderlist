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
    $statement = $database->query("SELECT * FROM tasks WHERE user_id = $userId ORDER BY completed_at ASC");
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

function getTodaysTasks($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->query("SELECT * FROM tasks WHERE user_id = $userId AND deadline_at = DATE() ORDER BY completed_at ASC");
    $todaysTasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $todaysTasks;
}

function tasksInList($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->query("SELECT * FROM tasks INNER JOIN lists
    ON tasks.list_id = lists.id WHERE tasks.user_id = $userId ORDER BY tasks.completed_at ASC");
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

function isChecked($task): bool
{
    if ($task['completed_at'] === NULL) {
        return false;
    } else {
        return true;
    }
}
