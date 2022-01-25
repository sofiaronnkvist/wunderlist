<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//complete all tasks
if (isset($_POST['completeAll'])) {

    $id = filter_var($_POST['completeAll']);

    $SQLquery = ("UPDATE tasks SET completed_at = DATE() WHERE list_id = :id");

    $statement = $database->prepare($SQLquery);

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    redirect('/');
}
