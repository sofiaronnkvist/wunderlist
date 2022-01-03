<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<section>
    <?php if (!isUserLoggedIn()) : ?>
        <h1>Welcome to <?= $config['title']; ?></h1>
        <p>A clean, simple space to organize all of your tasks and to do-lists.</p>
    <?php endif; ?>

    <?php if (isUserLoggedIn()) : ?>
        <h1>Hello, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</h1>
        <p>This is your Wunderlist. Scroll around to see all of your tasks and lists.</p>
    <?php endif; ?>
</section>
<section>
    <?php if (isUserLoggedIn()) : ?>
        <h2>All tasks</h2>
        <ul>
            <?php foreach (getTasks($database) as $task) : ?>
                <li><?= htmlspecialchars($task['task_title']); ?></li>
                <form action="/app/tasks/completed.php" method="post">
                    <input type="checkbox" name="completed" id="completed" value="<?= date("Y-m-d") ?>">
                </form>
                <ul>
                    <li><?= htmlspecialchars($task['task_description']) ?></li>
                    <form action="/app/tasks/delete.php" method="post">
                        <button name="delete-task" type="submit" class="btn btn-primary" value="<?= $task['id'] ?>">Delete</button>
                    </form>
                </ul>
            <?php endforeach; ?>
        </ul>
        <h2>Due today</h2>
        <ul>
            <?php foreach (getTodaysTasks($database) as $today) : ?>
                <li><?= htmlspecialchars($today['task_title']); ?></li>
                <ul>
                    <li><?= htmlspecialchars($today['task_description']) ?></li>
                    <form action="/app/tasks/delete.php" method="post">
                        <button name="delete-task" type="submit" class="btn btn-primary" value="<?= $task['id'] ?>">Delete</button>
                    </form>
                </ul>
            <?php endforeach; ?>
        </ul>
        <h3>Add a task</h3>
        <form action="app/tasks/store.php" method="post">
            <div class="mb-3">
                <label for="task-title">Add a title</label>
                <input class="form-control" type="task-title" name="task-title" id="task-title" placeholder="Title" required>
            </div>
            <div class="mb-3">
                <label for="task-description">Add a description</label>
                <input class="form-control" type="task-description" name="task-description" id="task-description" placeholder="Description" required>
            </div>
            <div class="mb-3">
                <label for="task-deadline">Add a due date</label>
                <input class="form-control" type="date" name="task-deadline" id="task-deadline" required>
            </div>
            <div class="mb-3">
                <label for="task-list">Choose a list (if you want to)</label>
                <select name="task-list" id="task-list">
                    <option value="">Choose...</option>
                    <?php foreach (getLists($database) as $list) : ?>
                        <option value="<?= $list['id']; ?>">
                            <?= htmlspecialchars($list['list_title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
</section>
<section>
    <h2>All lists</h2>
    <ul>
        <?php foreach (getLists($database) as $list) : ?>
            <li><?= htmlspecialchars($list['list_title']); ?></li>
            <form action="/app/lists/delete.php" method="post">
                <button name="delete-list" type="submit" class="btn btn-primary" value="<?= $list['id'] ?>">Delete</button>
            </form>
            <ul>
                <?php foreach (tasksInList($database) as $task) : ?>
                    <?php if ($task['list_id'] === $list['id']) : ?>
                        <li><?= htmlspecialchars($task['task_title']); ?></li>
                        <ul>
                            <li><?= htmlspecialchars($task['task_description']) ?></li>
                            <form action="/app/lists/task-delete.php" method="post">
                                <button name="delete-task-list" type="submit" class="btn btn-primary" value="<?= $task['id'] ?>">Delete</button>
                            </form>
                        </ul>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </ul>
    <h3>Add a list</h3>
    <form action="app/lists/store.php" method="post">
        <div class="mb-3">
            <label for="list-title">Add a title</label>
            <input class="form-control" type="list-title" name="list-title" id="list-title" placeholder="Title" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
<?php endif; ?>
</section>

<?php require __DIR__ . '/views/footer.php'; ?>
