<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<section>
    <?php if (!isUserLoggedIn()) : ?>
        <div class="public-intro">
            <h1>Welcome to <?= $config['title']; ?></h1>
            <p>A clean, simple space to organize all of your tasks and to do-lists.</p>
        </div>
        <div class="login-box">
            <a class="link" href="/login.php">Login</a>
            <a class="link" href="/register.php">Register</a>
        </div>
        <article class="about-container">
            <h2>Why use a to-do list?</h2>
            <p>By keeping a list of things to do, you will get the easy gratification of checking things off when you’ve done them. Grouping them in lists also makes it easy to get an overview!</p>
        </article>
        <div class="about-image-container">
            <img class="about-image" src="/assets/images/flower.png" alt="Flower.">
        </div>
    <?php endif; ?>
    <?php if (isUserLoggedIn()) : ?>
        <div class="private-intro">
            <h1>Hello, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</h1>
            <p>This is your Wunderlist. Scroll around to see all of your tasks and lists.</p>
        </div>
    <?php endif; ?>
</section>
<section>
    <?php if (isUserLoggedIn()) : ?>
        <?php $lists = getLists($database); ?>
        <div class="all-tasks-container">
            <div class="tasks-container">
                <h2>All tasks</h2>
                <ul>
                    <?php foreach (getTasks($database) as $task) : ?>
                        <div class="task-box">
                            <div class="task-header">
                                <input type="checkbox" name="completed" id="completed" class="checkbox" data-id="<?= $task['id'] ?>" data-set="<?= isChecked($task) ?>">
                                <li><?= htmlspecialchars($task['task_title']); ?></li>
                                <button class="task-button" data-id="<?= $task['id'] ?>">+</button>
                            </div>
                            <div class="task-unfold closed" data-id="<?= $task['id'] ?>">
                                <ul>
                                    <li><?= htmlspecialchars($task['task_description']) ?></li>
                                    <p>Deadline: <?= htmlspecialchars($task['deadline_at']); ?></p>
                                    <?php if ($task['list_id']) : ?>
                                        <?php foreach (getListName($database, $task['id']) as $list) : ?>
                                            <p>List: <?= htmlspecialchars($list['list_title']); ?></p>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <form action="/app/tasks/delete.php" method="post">
                                        <button name="delete-task" type="submit" class="" value="<?= $task['id'] ?>">Delete</button>
                                    </form>
                                    <button name="edit-task" data-id="<?= $task['id'] ?>" type="submit" class="edit-task-button">Edit</button>
                                </ul>
                            </div>
                            <div class="edit-task closed" data-id="<?= $task['id'] ?>">
                                <form action="app/tasks/update.php" method="post" class="edit-task">
                                    <div class="mb-3">
                                        <label for="task-title">Change title</label>
                                        <input class="form-control" type="task-title" name="task-title" id="task-title" placeholder="<?= $task['task_title'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="task-description">Change description</label>
                                        <input class="form-control" type="task-description" name="task-description" id="task-description" placeholder="<?= $task['task_description'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="task-deadline">Change due date</label>
                                        <input class="form-control" type="date" name="task-deadline" id="task-deadline" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="task-list">Change list (if you want to)</label>
                                        <select name="task-list" id="task-list">
                                            <option value="">Choose...</option>
                                            <?php foreach ($lists as $list) : ?>
                                                <option value="<?= $list['id']; ?>">
                                                    <?= htmlspecialchars($list['list_title']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button name="update-task" type="submit" class="" value="<?= $task['id'] ?>">Save</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="due-today-container">
                <h2>Due today</h2>
                <ul>
                    <?php foreach (getTodaysTasks($database) as $today) : ?>
                        <div class="task-box">
                            <div class="task-header">
                                <input type="checkbox" name="completed" id="completed" class="checkbox" data-id="<?= $today['id'] ?>" data-set="<?= isChecked($today) ?>">
                                <li><?= htmlspecialchars($today['task_title']); ?></li>
                                <button class="task-button-today" data-id="<?= $today['id'] ?>">+</button>
                            </div>
                            <div class="task-unfold-today closed" data-id="<?= $today['id'] ?>">
                                <p><?= htmlspecialchars($today['task_description']) ?></p>
                                <p>Deadline: <?= htmlspecialchars($today['deadline_at']); ?></p>
                                <?php if ($today['list_id']) : ?>
                                    <?php foreach (getListName($database, $today['id']) as $list) : ?>
                                        <p>List: <?= htmlspecialchars($list['list_title']); ?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <form action="/app/tasks/delete.php" method="post">
                                    <button name="delete-task" type="submit" class="" value="<?= $task['id'] ?>">Delete</button>
                                </form>
                                <button name="edit-task" data-id="<?= $today['id'] ?>" type="submit" class="edit-today-button">Edit</button>
                            </div>
                            <div class="task-edit-today closed" data-id="<?= $today['id'] ?>">
                                <form action="app/tasks/update.php" method="post" class="edit-task">
                                    <div class="mb-3">
                                        <label for="task-title">Change title</label>
                                        <input class="form-control" type="task-title" name="task-title" id="task-title" placeholder="<?= $today['task_title'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="task-description">Change description</label>
                                        <input class="form-control" type="task-description" name="task-description" id="task-description" placeholder="<?= $today['task_description'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="task-deadline">Change due date</label>
                                        <input class="form-control" type="date" name="task-deadline" id="task-deadline" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="task-list">Change list (if you want to)</label>
                                        <select name="task-list" id="task-list">
                                            <option value="">Choose...</option>
                                            <?php foreach ($lists as $list) : ?>
                                                <option value="<?= $list['id']; ?>">
                                                    <?= htmlspecialchars($list['list_title']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button name="update-task" type="submit" value="<?= $today['id'] ?>">Save</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </ul>
            </div>
            </ul>
        </div>
        <div class="add-task">
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
                        <?php foreach ($lists as $list) : ?>
                            <option value="<?= $list['id']; ?>">
                                <?= htmlspecialchars($list['list_title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="">Save</button>
            </form>
        </div>
    <?php endif; ?>
</section>
<section>
    <?php if (isUserLoggedIn()) : ?>
        <div class="lists-container">
            <h2>All lists</h2>
            <ul>
                <?php foreach (getLists($database) as $list) : ?>
                    <div class="list-box">
                        <div class="list-header">
                            <li><?= htmlspecialchars($list['list_title']); ?></li>
                            <button class="list-button" data-id="<?= $list['id'] ?>">+</button>
                        </div>
                        <form action="/app/lists/delete.php" method="post">
                            <button name="delete-list" type="submit" class="" value="<?= $list['id'] ?>">Delete</button>
                        </form>
                        <button name="edit-list" data-id="<?= $list['id'] ?>" type="submit" class="edit-list-button">Edit</button>
                        <div class="edit-list closed" data-id="<?= $list['id'] ?>">
                            <form action="app/lists/update.php" method="post">
                                <div class="">
                                    <label for="list-title">Change title</label>
                                    <input class="form-control" type="list-title" name="list-title" id="list-title" placeholder="<?= $list['list_title'] ?>" required>
                                </div>
                                <button name="update-list" type="submit" class="" value="<?= $list['id'] ?>">Save</button>
                            </form>
                        </div>
                        <form action="app/tasks/completeAll.php" method="POST">
                            <input type="hidden" name="completeAll" value="<?= $list['id']; ?> ">
                            <button type="submit" class="complete-all-tasks">Complete all tasks</button>
                        </form>
                        <div class="list-unfold closed" data-id="<?= $list['id'] ?>">
                            <ul>
                                <?php foreach (tasksInList($database, $list['id']) as $task) : ?>
                                    <div class="task-box-lists">
                                        <div class="task-header">
                                            <input type="checkbox" name="completed" id="completed" class="checkbox" data-id="<?= $task['id'] ?>" data-set="<?= isChecked($task) ?>">
                                            <li><?= htmlspecialchars($task['task_title']); ?></li>
                                            <button class="task-button-list" data-id="<?= $task['id'] ?>">+</button>
                                        </div>
                                        <div class="task-list-unfold closed" data-id="<?= $task['id'] ?>">
                                            <ul>
                                                <li><?= htmlspecialchars($task['task_description']) ?></li>
                                                <p>Deadline: <?= htmlspecialchars($task['deadline_at']); ?></p>
                                                <p>List: <?= htmlspecialchars($list['list_title']) ?></p>
                                                <form action="/app/lists/task-delete.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                                    <button type="submit">Delete</button>
                                                </form>
                                                <button name="edit-task" data-id="<?= $task['id'] ?>" type="submit" class="edit-task-in-list">Edit</button>
                                            </ul>
                                        </div>
                                        <div class="task-edit-in-list closed" data-id="<?= $task['id'] ?>">
                                            <form action="app/tasks/update.php" method="post" class="edit-task">
                                                <div class="">
                                                    <label for="task-title">Change title</label>
                                                    <input class="form-control" type="task-title" name="task-title" id="task-title" placeholder="<?= $task['task_title'] ?>" required>
                                                </div>
                                                <div class="">
                                                    <label for="task-description">Change description</label>
                                                    <input class="form-control" type="task-description" name="task-description" id="task-description" placeholder="<?= $task['task_description'] ?>" required>
                                                </div>
                                                <div class="">
                                                    <label for="task-deadline">Change due date</label>
                                                    <input class="form-control" type="date" name="task-deadline" id="task-deadline" required>
                                                </div>
                                                <div class="">
                                                    <label for="task-list">Change list (if you want to)</label>
                                                    <select name="task-list" id="task-list">
                                                        <option value="">Choose...</option>
                                                        <?php foreach ($lists as $list) : ?>
                                                            <option value="<?= $list['id']; ?>">
                                                                <?= htmlspecialchars($list['list_title']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <button name="update-task" type="submit" value="<?= $task['id'] ?>">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="add-list">
            <h3>Add a list</h3>
            <form action="app/lists/store.php" method="post">
                <div class="mb-3">
                    <label for="list-title">Add a title</label>
                    <input class="form-control" type="list-title" name="list-title" id="list-title" placeholder="Title" required>
                </div>
                <button type="submit" class="">Save</button>
            </form>
        </div>
    <?php endif; ?>
</section>

<?php require __DIR__ . '/views/footer.php'; ?>