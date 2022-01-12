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
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare('SELECT list_title FROM lists INNER JOIN tasks ON tasks.list_id = lists.id WHERE tasks.id = :id AND tasks.user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $listTitle = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $listTitle;
}

function getLists($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare("SELECT * FROM lists WHERE user_id = :user_id");
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $lists = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $lists;
}

function getTasks($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY completed_at ASC");
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

function getTodaysTasks($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare("SELECT * FROM tasks WHERE user_id = :user_id AND deadline_at = DATE() ORDER BY completed_at ASC");
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $todaysTasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $todaysTasks;
}

function tasksInList($database): array
{
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare("SELECT tasks.id, tasks.list_id, tasks.user_id, tasks.task_title,
    tasks.task_description, tasks.created_at, tasks.deadline_at, tasks.completed_at, lists.list_title FROM tasks INNER JOIN lists
    ON tasks.list_id = lists.id WHERE tasks.user_id = :user_id ORDER BY tasks.completed_at ASC");
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

function isChecked($task): bool
{
    if ($task['completed_at'] === null) {
        return false;
    } else {
        return true;
    }
}
